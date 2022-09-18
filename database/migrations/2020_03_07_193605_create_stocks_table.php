<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('quantiteAnterieur');
                $table->integer('quantiteActuel');
                $table->integer('variationQuantite');
            
                $table->integer('produit_id')->unsigned();
                $table->foreign('produit_id')->references('id')->on('produits');
            
//                $table->integer('user_id')->unsigned();
//                $table->foreign('user_id')->references('id')->on('users');
            
                $table->integer('approvisionnement_id')->nullable()->unsigned();
                $table->foreign('approvisionnement_id')->references('id')->on('approvisionnements');

                $table->integer('calibre_id')->nullable()->unsigned();
                $table->foreign('calibre_id')->references('id')->on('calibres');

//                $table->integer('ajustement_id')->nullable()->unsigned();
//                $table->foreign('ajustement_id')->references('id')->on('ajustements');
//
//                $table->integer('don_id')->nullable()->unsigned();
//                $table->foreign('don_id')->references('id')->on('dons');
//

                $table->integer('vente_id')->nullable()->unsigned();
                $table->foreign('vente_id')->references('id')->on('ventes');
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
        Schema::dropIfExists('stocks');
    }
}
