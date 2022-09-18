<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduitVente extends Model
{
    public function prod()
    {
        return $this->belongsTo(Produit::class,'produit_id');      
    }
    public function cal()
    {
        return $this->belongsTo(Calibre::class,'calibre_id');      
    }
}
