<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rebut;
use App\Stock;
use Validator;


class RebutController extends Controller
{
    
    public function getRebut(){
        $reb = Rebut::all() ;
         
        foreach($reb as $value){
            $value -> cal ->produit;
            
        }
        return $reb;
    }
    
    
    public function addRebut(Request $request){
        
        $valide = Validator::make($request->all(), [
          'idRebut' => 'required|integer',
          'quantiteRebut' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $stocks  = Stock::where('calibre_id',$request['idRebut'])-> latest('id')->first();
//        dd($stocks);
        if($stocks ){
            if($stocks['quantiteActuel'] > $request['quantiteRebut']){
                $rebut  = new Rebut();
                $rebut -> qunatite= $request['quantiteRebut'];
                $rebut -> calibre_id= $request['idRebut'];
                $rebut -> save();

                $stock = new Stock ();
                $stock -> quantiteAnterieur = $stocks['quantiteActuel'];
                $stock -> quantiteActuel = $stocks['quantiteActuel'] - $request['quantiteRebut'];
                $stock -> variationQuantite = $request['quantiteRebut'];
                $stock -> produit_id = $stocks['produit_id'];
                $stock -> calibre_id = $stocks['calibre_id'];
                $stock -> save();
            }
            else{
                return response()->json(['fail' =>true,'errors' =>[['Stock inssuffisant. Veuillez vérifiez le stock avant d\' effectuer cette opération']]]);
            }
            
        }
        else{
                return response()->json(['fail' =>true,'errors' =>[['Stock inssuffisant. Veuillez vérifiez le stock avant d\' effectuer cette opération']]]);
            }
        
                                                  
        return $rebut;
    }
}
