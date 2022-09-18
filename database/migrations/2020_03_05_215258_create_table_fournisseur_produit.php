<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFournisseurProduit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseur_produit', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('fournisseur_id')->unsigned()->nullable();
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');

            $table->integer('produit_id')->unsigned()->nullable();
            $table->foreign('produit_id')->references('id')->on('produits');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseur_produit');
    }
}
