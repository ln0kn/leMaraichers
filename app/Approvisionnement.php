<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    public function produit()
    {
        return $this->hasMany('App\ApprovisionnementProduit');      
    }
    
    public function stock()
    {
//        return $this->hasMany('App\Stock','approvissionnements_id');
        return $this->hasMany('App\Stock','approvisionnement_id');
    }
}
