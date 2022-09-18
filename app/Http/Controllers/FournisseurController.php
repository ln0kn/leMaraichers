<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use Illuminate\Http\Request;
use Validator;
class FournisseurController extends Controller
{
    
    public function getFournisseur(){
        $tab =[];
        $fournisseur = Fournisseur::all();
        foreach ($fournisseur as $key => $value) {
          $tab[$key]=$value;
          $tabT='';
          foreach ($value -> produits  as $val) {
            $tabT .= $val -> designationProduit .', ';
          }  
//            dd($tabT);
//          $tabT = substr($tabT,0,15);
          $tabT = $tabT;
          $tab[$key]['prod']='[ '.$tabT.' ]' ;
        }
        return $tab;
    }
    
    public function addFournisseur(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'designationFournisseur' => 'required|unique:fournisseurs',
          'contactFournisseur' => 'nullable',
          'produitFournisseur' => 'required',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $fournisseur = new Fournisseur();
        $fournisseur -> designationFournisseur = $request['designationFournisseur'];
        $fournisseur -> contactFournisseur = $request['contactFournisseur'];
        $fournisseur -> save() ;
        
        $fournisseur->produits()->attach($request['produitFournisseur']);
        
        return $fournisseur ;
    }
    
    public function updateFournisseur(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'designationFournisseur' => 'required|unique:fournisseurs,designationFournisseur,'.$request['idFournisseur'].'id',
          'contactFournisseur' => 'nullable',
          'produitFournisseur' => 'required',
          'idFournisseur' => 'required',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        
        $fournisseur = Fournisseur::find($request['idFournisseur']);
        $fournisseur->produits()->detach();
        
        $fournisseur -> designationFournisseur = $request['designationFournisseur'];
        $fournisseur -> contactFournisseur = $request['contactFournisseur'];
        $fournisseur -> save() ;
        
        
        $fournisseur->produits()->attach($request['produitFournisseur']);
        
        return $fournisseur ;
    }
    
    public function deleteFournisseur(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'idFournisseur' => 'required',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        
        $fournisseur = Fournisseur::find($request['idFournisseur']);
        $fournisseur->produits()->detach();
        $fournisseur->delete();
        
        return $fournisseur ;
    }
    
}
