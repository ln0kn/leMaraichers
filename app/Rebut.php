<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rebut extends Model
{
    public function cal()
  {
      return $this->belongsTo(Calibre::class,'calibre_id');
  }
}
