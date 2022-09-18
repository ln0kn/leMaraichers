<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cloture;
use App\Vente;
use App\Produit;
use PDF;
class ClotureController extends Controller
{
    
    
    public function addCloture(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'dateCloture' => 'required|date|unique:clotures',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }

        $timestamp = strtotime($request['dateCloture']);

        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('y', $timestamp);
        $result = 'CL/'.$day.'/'.$month.'/'.$year;
        $clo = new Cloture ();
        $clo -> identifiantCloture = $result;
        $clo -> dateCloture = $request['dateCloture'];
        $clo -> save ();
        
        return $clo ;
    }
    
    public function getCloture(Request $request){
        return Cloture::all() ;
    }
    
    
    
    public function bilan(Request $request){
        $valide = $validator = Validator::make($request->all(), [
          'date' => 'required',
          
        ]);

        if ($valide->fails()) {
          return response()->json([
            'fail' =>true,
            'errors' => $valide->errors()
          ]);
        }
        


        $tab = [];
        $tab2 = [];//lontant des ventes par calibre
        $tab3 = [];//quantite 
        $sommeVente = 0;
        $sommePercu = 0;
        $sommeCredit = 0;
        $sommeRemise = 0;
        $sommeTotal = 0;
        $timestamp = strtotime($request['date']);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);
        $date = $year.'-'.$month.'-'.$day;
        

        $ventes = Vente::whereDate('created_at',$date)->get();
//        $ventes = Vente::with('vente')->whereDate('created_at',$date)->get();
//        dd($ventes);

//        $pdf = PDF::loadView('Mes_vues.Clotures', ['somme'=>$somme,'qte'=>$qte,'vte'=>$vte,'tab2'=>$tab2,'tab'=>$tab,'tab3'=>$tab3]);
//        return $pdf->download('venteidentifiantVentes.pdf');

        foreach($ventes as $vente){
            foreach ($vente -> produit as $key => $produit){
                $tab[$produit -> cal ->id] = $produit -> prod -> designationProduit .' '.$produit -> cal ->calibre;
                $tab2[$produit -> cal ->id] = 0;
                $tab3[$produit -> cal ->id] = 0;
            }
        }

        foreach($ventes as $vente){
            foreach ($vente -> produit as $key => $produit){
//                $tab[$produit -> cal ->id] = $produit -> prod -> designationProduit .' '.$produit -> cal ->calibre;
                $tab2[$produit -> cal ->id] = $tab2[$produit -> cal ->id] + $produit -> quantite;
                $tab3[$produit -> cal ->id] = $tab3[$produit -> cal ->id] + $produit -> quantite;
            }
            $sommeTotal += $vente -> montantVente;
            $sommeVente += $vente -> sommeAPayer;
            $sommeRemise += $vente -> montantRemise;
            $sommePercu += $vente -> sommePayer;
            $sommeCredit +=  $vente -> sommeRestante;
        }

//        dd($sommeCredit);
        $pdf = PDF::loadView('mesVues.clotures', ['sommeVente'=>$sommeVente,'montantRemise'=>$sommeRemise,'sommePercu'=>$sommePercu,'sommeCredit'=>$sommeCredit,'date'=>$request['date'],'tab'=>$tab,'tab2'=>$tab2,'tab3'=>$tab3,'sommeTotal'=>$sommeTotal]);
        return $pdf->download('Cl'.$request['date'].'.pdf');


        
        return $tab3;
    }
    
}
