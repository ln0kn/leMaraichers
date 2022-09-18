<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Ajustement;
use App\Stock;
use Illuminate\Http\Request;
use Validator;
use Auth;
class StockController extends Controller
{
    
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:4');
         $this->middleware('permission');
    }
    
    public function urlPlus(Request $request){

        $tab2 = ['','Cartons','Sacs'];
        $tab = [];
        $i = 0;
        $produits = Produit::with('calibre') -> get() ;
        foreach ($produits as $key => $value) {
            foreach ($value -> calibre as  $val) {
            $k =($val ->  stock()) ? $val -> stock() -> latest('id')->first() : 0 ;
            $k =($k) ? $k['quantiteActuel'] .' '.$tab2[$value -> conditionnementProduit]  : 0 ;
            $tab[$i]= $value -> designationProduit.' '.$val -> calibre.' [ '.$k.' ]';          
            $i++;
            }
        }
        return $tab;

    }


    public function index(){
        return view('mesVues.stocks');
    }

    public function getStock(){
        
        $tab2 = ['','Cartons','Sacs'];
        $tab = [];
        $i = 0;
        $produits = Produit::with('calibre') -> get() ;
        foreach ($produits as $key => $value) {
            foreach ($value -> calibre as  $val) {
            $k =($val ->  stock()) ? $val -> stock() -> latest('id')->first() : 0 ;
            $k =($k) ? $k['quantiteActuel'] .' '.$tab2[$value -> conditionnementProduit]  : 0 ;
            $tab[$i]['designation']= $value -> designationProduit.' '.$val -> calibre;          
            $tab[$i]['id']= $val -> id ;          
            $tab[$i]['quantite']= $k ;          
            $i++;
            }
        }
        return $tab;
    }
    
    public function getAjustement(){
        $ajst = Ajustement::all() ;
         
        foreach($ajst as $value){
            $value -> cal ->produit;
            
        }
        return $ajst;
    }
    
    
    public function addAjustement(Request $request){
        
        $valide = Validator::make($request->all(), [
          'idAjustement' => 'required|integer',
          'quantitePhysique' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $stock  = Stock::where('calibre_id',$request['idAjustement'])-> latest('id')->first();
//        dd($stock);
        $ajustement  = new Ajustement();
        $ajustement -> qunatiteNumerique = $stock['quantiteActuel'];
        $ajustement -> quantitePhysique= $request['quantitePhysique'];
        $ajustement -> calibre_id= $request['idAjustement'];
        $ajustement -> save();
        
        $stock -> quantiteAnterieur  = $stock['quantiteActuel'];
        $stock -> quantiteActuel = $request['quantitePhysique'];
        $stock ->  save();
                                                  
        return $ajustement;
    }

}
