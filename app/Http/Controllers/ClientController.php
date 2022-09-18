<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Client;
class ClientController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:2');
         $this->middleware('permission');
    }
    
    
    public function index(){
        return view('mesVues.clients');
    }
    
    public function getClient(){
        return Client::all();
    }
    
    public function addClient(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'nomClient' => 'required|string',
          'telephoneClient' => 'required|integer|unique:clients,telephoneClient',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $client = new Client();
        $client -> nomClient = $request['nomClient'];
        $client -> telephoneClient = $request['telephoneClient'];
        $client -> save();
        return $client;
    }
    
    
    public function updateClient(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'nomClient' => 'required|string',
          'idClient' => 'required|integer',
          'telephoneClient' => 'required|integer|unique:clients,telephoneClient,'.$request['idClient'].'id',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $client = Client::find($request['idClient']);
        $client -> nomClient = $request['nomClient'];
        $client -> telephoneClient = $request['telephoneClient'];
        $client -> save();
        return $client;
    }
    
    
    public function deleteClient(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'idClient' => 'required|integer',
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $client = Client::find($request['idClient']);
        $client -> delete();
        return $client;
    }
}
