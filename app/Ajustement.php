<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajustement extends Model
{
    public function cal()
  {
      return $this->belongsTo(Calibre::class,'calibre_id');
  }
}
