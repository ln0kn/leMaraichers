<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApprovissionnementProduit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnement_produit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantite');
            
            $table->integer('approvisionnement_id')->unsigned();
            $table->foreign('approvisionnement_id')->references('id')->on('approvisionnements');
            $table->integer('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->integer('calibre_id')->unsigned();
            $table->foreign('calibre_id')->references('id')->on('calibres');
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
        Schema::dropIfExists('approvisionnement_produit');
    }
}
