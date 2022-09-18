<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Versement;
use App\Client;
class VersementController extends Controller
{
    
    public function getVersement(){
        return Versement::with('client') -> get();
    }
    
    public function getHistorique(Request $request){
        $hist = Client::find($request['data']);
        return $hist -> versement ;
    }
    
    
    public function addVersement(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'idVersement' => 'required|integer',
          'sommeVersee' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $versement = new Versement();
        $versement -> client_id = $request['idVersement'];
        $versement -> sommeVersee = $request['sommeVersee'];
        
        $client = Client ::find($request['idVersement']);
        $client -> increment('solde',$request['sommeVersee']);
        $client -> save ();
        $versement -> save();
        
        return $versement;
    }
}
