<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_ventes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantite');
            $table->integer('prix');
            
            $table->integer('vente_id')->unsigned();
            $table->foreign('vente_id')->references('id')->on('ventes');
            $table->integer('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->integer('calibre_id')->unsigned();
            $table->foreign('calibre_id')->references('id')->on('calibres');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_ventes');
    }
}
