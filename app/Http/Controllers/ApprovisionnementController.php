<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Approvisionnement;
use App\ApprovisionnementProduit;
use App\Produit;
use App\Stock;
use Validator;
//use Validator;

class ApprovisionnementController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:32');
         $this->middleware('permission');
    }
    
    
     public function index(){
         $produits = Produit::with('calibre') -> get() ;
         
//         print_r($produits);
        return view('mesVues.approvisionnements') -> withProduits($produits);
    }
    
    public function addApprovisionnement(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'data.*.produit' => 'required|integer',
          'data.*.quantite' => 'required|integer',
          'data.*.calibre' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $timestamp = strtotime(now());
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('y', $timestamp);
        $result = Approvisionnement::latest('id')->first();
        $result = 'App/'.$day.'/'.$month.'/'.$year.'/'.(($result)?$result['id']+1:1);
        
        $app = new Approvisionnement();
        $app -> identifiant = $result;
        $app -> save();
        
        foreach ($request['data'] as $key => $value) {
            $appP = new ApprovisionnementProduit();
            $appP -> quantite = $value['quantite'];
            $appP -> produit_id = $value['produit'];
            $appP -> calibre_id = $value['calibre'];
            $appP -> approvisionnement_id = $app -> id;
            $appP -> save();
            
            
            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where('calibre_id',$value['calibre']) -> latest('id')->first();

            //adding in the stock
            $stock = new Stock ();
            $stock -> quantiteAnterieur = ($prod) ? $prod['quantiteActuel'] : 0;
            $stock -> quantiteActuel = ($prod)? $prod['quantiteActuel'] + ($value['quantite']):($value['quantite']);
            $stock -> variationQuantite = $value['quantite'];
            $stock -> produit_id = $value['produit'];
            $stock -> calibre_id = $value['calibre'];
            $stock -> approvisionnement_id = $app -> id;
            $stock -> save();

        }

        return $app;
    }
    
    
    public function updateApprovisionnement(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'data.*.produit' => 'required|integer',
          'data.*.quantite' => 'required|integer',
          'data.*.calibre' => 'required|integer',
          'data.*.id' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        
        $ctr =true;
        foreach ($request['data'] as $key => $value) {
            if($ctr){
                $app = Approvisionnement::find($value['id']);
                $app -> stock() ->delete ();
                $app -> produit() -> delete ();
                
                $ctr = false;
            }
            
            $appP = new ApprovisionnementProduit();
            $appP -> quantite = $value['quantite'];
            $appP -> produit_id = $value['produit'];
            $appP -> calibre_id = $value['calibre'];
            $appP -> approvisionnement_id = $app -> id;
            $appP -> save();
            
            
            
            //savoir si le produit existe en stock
            $prod = Stock::where('produit_id',$value['produit']) -> where ('calibre_id',$value['calibre']) -> latest('id')->first();

            //adding in the stock
            $stock = new Stock ();
            $stock -> quantiteAnterieur = ($prod) ? $prod['quantiteActuel'] : 0;
            $stock -> quantiteActuel = ($prod)? $prod['quantiteActuel'] + ($value['quantite']):($value['quantite']);
            $stock -> variationQuantite = $value['quantite'];
            $stock -> calibre_id = $value['calibre'];
            $stock -> produit_id = $value['produit'];
            $stock -> approvisionnement_id = $app -> id;
            $stock -> save();

        }

        return $app;
    }
    
    
    public function deleteApprovisionnement(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'data.*.produit' => 'required|integer',
          'data.*.quantite' => 'required|integer',
          'data.*.calibre' => 'required|integer',
          'data.*.id' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        $app = Approvisionnement::find($request['idApprovisionnement']); 
        
        //ajusteer approvissionnement produit
        foreach ( $app -> stock as $key => $value) {
            //savoir si le produit existe en stock
            $qte = Stock::where('produit_id',$value['produit_id']) -> where ('calibre_id',$value['calibre_id'])-> latest('id')->first();

            $stock = new Stock ();
            $stock -> quantiteAnterieur = $qte['quantiteActuel'];
            $stock -> quantiteActuel = $qte['quantiteActuel'] - $value['variationQuantite'];
            $stock -> variationQuantite = $value['variationQuantite'];
            $stock -> produit_id = $value['produit_id'];
            $stock -> calibre_id = $value['calibre_id'];
//            $stock -> approvisionnement_id = $request['idApprovisionnement'];
            $stock -> save();

        }

        $app -> stock() -> delete();
        $app -> produit() ->delete ();
        $app -> delete ();

        return $app;
        }
    
    
    
    public function getApprovisionnement(){
        $app = Approvisionnement::with('produit')->get();
        return $app;
    }
    
    
    
    
    
}
