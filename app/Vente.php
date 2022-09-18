<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public function produit()
    {
        return $this->hasMany('App\ProduitVente');      
    }
    
     public function stock()
    {
        return $this->hasMany('App\Stock','vente_id');
    }
}
