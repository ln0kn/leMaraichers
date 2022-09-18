<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public function calibre()
    {
        return $this->hasMany('App\Calibre');      
    }
}
