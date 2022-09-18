<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Produit;
use App\Calibre;


class ProduitController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:1');
         $this->middleware('permission');
         
    }
    
    
    public function index (){
        $produits = Produit::all();
        return view('mesVues.produits')->withProduits($produits);
    }
    
    
    public function getProduit (){
        $tab =[];
        $produits = Produit::all();
        foreach ($produits as $key => $value) {
          $tab[$key]=$value;
          $tabT='';
          foreach ($value -> calibre  as $val) {
            $tabT .= $val -> calibre .', ';
          }  
          $tabT = substr($tabT,0,15);
          $tab[$key]['cal']='[ '.$tabT.' ]' ;
        }
        return $tab;
    }
    
    
    public function addProduit(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'designationProduit' => 'required|unique:produits',
          'conditionnementProduit' => 'required|integer',
          'calibreProduit' => 'required',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $produit = new Produit ();
        $produit -> designationProduit = $request['designationProduit'];
        $produit -> conditionnementProduit = $request['conditionnementProduit'];
        $produit -> caracteristiqueProduit = $request['caracteristiqueProduit'];
        $produit -> save() ;
        $valeur=(explode(",",$request['calibreProduit']));
        
        foreach($valeur as $val){
            $calibre = new Calibre ();
            $calibre -> calibre = $val;
            $calibre -> produit_id = $produit -> id;
            $calibre -> save() ;   
        }
        return $request ;
    }
    
    
    public function updateProduit(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'designationProduit' => 'required|unique:produits,designationProduit,'.$request['idProduit'].',id',
          'conditionnementProduit' => 'required|integer',
          'idProduit' => 'required|integer',
          'calibreProduit' => 'required',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $produit = Produit::find($request['idProduit']);
        $produit -> designationProduit = $request['designationProduit'];
        $produit -> conditionnementProduit = $request['conditionnementProduit'];
        $produit -> caracteristiqueProduit = $request['caracteristiqueProduit'];
        $produit -> save() ;
        $valeur=(explode(",",$request['calibreProduit']));
        $produit -> calibre () -> delete();
        foreach($valeur as $val){
            $calibre = new Calibre ();
            $calibre -> calibre = $val;
            $calibre -> produit_id = $produit -> id;
            $calibre -> save() ;   
        }
        return $request ;
    }
    
    public function deleteProduit (Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'idProduit' => 'required|integer',
        ]);
        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        $produit = Produit::find($request['idProduit']);
        $produit -> calibre () -> delete();
        $produit -> delete();
        return $produit;
    }
}
