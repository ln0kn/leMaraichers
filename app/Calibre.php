<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibre extends Model
{
    public function stock()
    {
        return $this->hasMany('App\Stock','calibre_id');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class,'produit_id');
    }
}
