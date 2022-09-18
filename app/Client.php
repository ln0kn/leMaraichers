<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function versement()
    {
        return $this->hasMany('App\Versement');      
    }
}
