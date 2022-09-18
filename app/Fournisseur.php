<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    public function produits()
  {
      return $this->belongsToMany('App\Produit','fournisseur_produit','fournisseur_id','produit_id');
  }

}
