<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use App\Vente;
use App\Stock;
use App\Client;
use App\ProduitVente;
use Validator;
use PDF;
class VenteController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:64');
         $this->middleware('permission');
    }
    
    
    public function index(){
        $clients = Client::all();
        $produits = Produit::with('calibre') -> get() ;
        return view('mesVues.ventes') -> withProduits($produits) -> withClients($clients);
    }
    
    
    public function getVente(){
//        $vente = Vente::with('produit')->get();
        $vente = Vente::all();
        foreach($vente as $value){
            foreach($value -> produit as $val){
            $val -> prod;
            $val -> cal;
        }
        }
        return $vente;
    }
    
    public function addVente(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'data.*.produit' => 'required|integer',
          'data.*.quantite' => 'required|integer',
          'data.*.calibre' => 'required|integer',
          'data.*.prixU' => 'required|integer',
          'data.*.montantPayer' => 'required|integer',
          'data.*.idClient' => 'nullable|integer',
          'data.*.nomClient' => 'nullable',
          'data.*.remise' => 'required|integer',
          'data.*.sommeTotal' => 'required|integer',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        ///////////verifier que le stock est suffis ant pour effectuer la vente
        foreach($request['data'] as $value){
           
            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where('calibre_id',$value['calibre']) -> latest('id')->first();
            
            if($prod['quantiteActuel'] > $value['quantite']){
             
            }else{
                return response()->json(['fail' =>true,'errors' =>[['Stock inssuffisant. Veuillez vérifiez le stock avant d\' effectuer cette vente']]]);
            }
        }
        
        
    
        $timestamp = strtotime(now());
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('y', $timestamp);
        $result = Vente::latest('id')->first();
        $result = 'Vte/'.$day.'/'.$month.'/'.$year.'/'.(($result)?$result['id']+1:1);
        
        $next = true;
//        dd($request);
        foreach($request['data'] as $value){
           if($next){
                $vente = new Vente();
                $vente -> identifiantVentes = $result;
                $vente -> nomClients = $value['nomClient'];
                $vente -> sommeAPayer = $value['sommeTotal'];
                $vente -> sommePayer = $value['montantPayer'];
                $vente -> sommeRestante = $value['sommeTotal'] - $value['montantPayer'];
                $vente -> montantVente = $value['sommeTotal'] + $value['remise'];
                $vente -> montantRemise = $value['remise'];
                $vente -> client_id= $value['idClient'];
                $vente -> save();
                $next = false;
           } 
            
            $appP = new ProduitVente();
            $appP -> quantite = $value['quantite'];
            $appP -> prix = $value['prixU'];
            $appP -> produit_id = $value['produit'];
            $appP -> calibre_id = $value['calibre'];
            $appP -> vente_id = $vente -> id;
            $appP -> save();


            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where('calibre_id',$value['calibre']) -> latest('id')->first();
            
            if($prod['quantiteActuel'] > $value['quantite']){
            
                //removung in the stock
                $stock = new Stock ();
                $stock -> quantiteAnterieur = $prod['quantiteActuel'];
                $stock -> quantiteActuel = $prod['quantiteActuel'] - $value['quantite'];
                $stock -> variationQuantite = $value['quantite'];
                $stock -> produit_id = $value['produit'];
                $stock -> calibre_id = $value['calibre'];
                $stock -> vente_id = $vente -> id;
                $stock -> save();
            }
        }

        return $vente;
        
        
    }
    
    
    public function deleteVente(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'idVente' => 'required|integer',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        $vente = Vente::find($request['idVente']);
        
        //handle stock state
        foreach($vente -> stock as $value){
            $qte = Stock::where('produit_id',$value['produit_id']) -> where ('calibre_id',$value['calibre_id'])-> latest('id')->first();
            $stock = new Stock ();
            $stock -> quantiteAnterieur = $qte['quantiteActuel'];
            $stock -> quantiteActuel = $qte['quantiteActuel'] + $value['variationQuantite'];
            $stock -> variationQuantite = $value['variationQuantite'];
            $stock -> produit_id = $value['produit_id'];
            $stock -> calibre_id = $value['calibre_id'];
            $stock -> save();
        }
        
        $vente -> stock() -> delete();
        $vente -> produit() ->delete ();
        $vente -> delete ();
    
        return $vente; 
    }
    
    
    
    
    
    public function updateVente (Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'data.*.produit' => 'required|integer',
          'data.*.quantite' => 'required|integer',
          'data.*.calibre' => 'required|integer',
          'data.*.prixU' => 'required|integer',
          'data.*.montantPayer' => 'required|integer',
          'data.*.idClient' => 'nullable|integer',
          'data.*.idVente' => 'required|integer',
          'data.*.nomClient' => 'nullable',
          'data.*.remise' => 'required|integer',
          'data.*.sommeTotal' => 'required|integer', 
        ]);
        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        $vente;
        
        ///////////verifier que le stock est suffis ant pour effectuer la vente
        foreach($request['data'] as $value){
           
            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where('calibre_id',$value['calibre']) -> latest('id')->first();
            
            if($prod['quantiteActuel'] > $value['quantite']){
             
            }else{
                return response()->json(['fail' =>true,'errors' =>[['Stock inssuffisant. Veuillez vérifiez le stock avant d\' effectuer cette vente']]]);
            }
            $vente = Vente::find($value['idVente']);
        }
//        dd($vente);
        
        //handle stock state
        foreach($vente -> stock as $value){
            $qte = Stock::where('produit_id',$value['produit_id']) -> where ('calibre_id',$value['calibre_id'])-> latest('id')->first();
            $stock = new Stock ();
            $stock -> quantiteAnterieur = $qte['quantiteActuel'];
            $stock -> quantiteActuel = $qte['quantiteActuel'] + $value['variationQuantite'];
            $stock -> variationQuantite = $value['variationQuantite'];
            $stock -> produit_id = $value['produit_id'];
            $stock -> calibre_id = $value['calibre_id'];
            $stock -> save();
        }
        
        $vente -> stock() -> delete();
        $vente -> produit() ->delete ();
//        $vente -> delete ();
        
        $next = true;
        foreach($request['data'] as $value){
           if($next){
                $vente -> sommeAPayer = $value['sommeTotal'];
                $vente -> sommePayer = $value['montantPayer'];
                $vente -> sommeRestante = $value['sommeTotal'] - $value['montantPayer'];
                $vente -> montantVente = $value['sommeTotal'] + $value['remise'];
                $vente -> montantRemise = $value['remise'];
                $vente -> save();
                $next = false;
           } 
            
            $appP = new ProduitVente();
            $appP -> quantite = $value['quantite'];
            $appP -> prix = $value['prixU'];
            $appP -> produit_id = $value['produit'];
            $appP -> calibre_id = $value['calibre'];
            $appP -> vente_id = $vente -> id;
            $appP -> save();


            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where('calibre_id',$value['calibre']) -> latest('id')->first();
            
            if($prod['quantiteActuel'] > $value['quantite']){
            
                //removung in the stock
                $stock = new Stock ();
                $stock -> quantiteAnterieur = $prod['quantiteActuel'];
                $stock -> quantiteActuel = $prod['quantiteActuel'] - $value['quantite'];
                $stock -> variationQuantite = $value['quantite'];
                $stock -> produit_id = $value['produit'];
                $stock -> calibre_id = $value['calibre'];
                $stock -> vente_id = $vente -> id;
                $stock -> save();
            }
        }
        
       return $vente; 
    }
    
    
    
    
    
    
    public function factureVente(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'date' => 'required',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        $prods = [];
        $tab = [];
//        $st = 0;
        
        
        $vente = Vente::find($request['date']);
        foreach($vente -> produit as $key => $value){
            $prods[$key]['designation'] = $value -> prod -> designationProduit .' '.$value -> cal ->calibre ;
            $prods[$key]['quantite'] = $value -> quantite ;
            $prods[$key]['prix'] = $value -> prix ;
            $prods[$key]['prixT'] = $value -> prix * $value -> quantite ;
//            $st += $value -> prix * $value -> quantite ;
            
        }
        
//        dd($prods);
        
        
        $client = Client::find($vente['client_id']);
        $tab['client'] = ($client) ?$client['nomClient']:$vente['nomClients'];
        $tab['sommePayer'] = $vente['sommePayer'] ;
        $tab['sommeAPayer'] = $vente['sommeAPayer'];
        $tab['remise'] = $vente['montantRemise'];
        $tab['sommeRestante'] = $vente['sommeRestante'] ;
        $tab['mtnVente'] = $vente['montantVente'];
        $tab['idVente'] = $vente['identifiantVentes'];
        $tab['date'] = $vente['created_at'];

//dd($tab);


        $pdf = PDF::loadView('mesVues.factures', ['tab'=>$tab,'prods'=>$prods]);
        return $pdf->download($vente['identifiantVentes'].'.pdf');


        
        return $tab3;
    }
    
    
    
    
    
    
    
    
    
    
}
