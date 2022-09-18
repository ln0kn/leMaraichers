<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Depense;
use Validator;

class DepenseController extends Controller
{
    
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:16');
         $this->middleware('permission');
    }
    
    public function getDepense(){
        return Depense::all();
    }
    
    
    public function addDepense(Request $request){
     $valide = $validator = Validator::make($request->all(), [
          'designationDepense' => 'required|max:255',
          'dateDepense' => 'required|date',
          'montantDepense' => 'required|integer',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $depense = new Depense();
        $depense -> designationDepense = $request['designationDepense'];
        $depense -> dateDepense = $request['dateDepense'];
        $depense -> montantDepense = $request['montantDepense'];
        $depense -> save();
        
        return $depense;
    }
    
    public function updateDepense(Request $request){
     $valide = $validator = Validator::make($request->all(), [
          'designationDepense' => 'required|max:255',
          'dateDepense' => 'required|date',
          'montantDepense' => 'required|integer',
          'idDepense' => 'required|integer',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $depense = Depense ::find($request['idDepense']);
        $depense -> designationDepense = $request['designationDepense'];
        $depense -> dateDepense = $request['dateDepense'];
        $depense -> montantDepense = $request['montantDepense'];
        $depense -> save();
        
        return $depense;
    }
    
    
    public function deleteDepense(Request $request){
     $valide = $validator = Validator::make($request->all(), [
          'idDepense' => 'required|integer',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        
        $depense = Depense ::find($request['idDepense']);
        $depense -> delete();
        
        return $depense;
    }
    
}
