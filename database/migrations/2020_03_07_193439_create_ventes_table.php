<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->increments('id');
            
                $table->string('identifiantVentes')->unique();
                $table->string('nomClients')->nullable();
                $table->integer('sommePayer')->comment('montant facture avec la remise si y en a');
                $table->integer('sommeAPayer');
                $table->integer('sommeRestante');
                $table->integer('montantVente')->comment('montant facture sans la remise');
                $table->integer('montantRemise')->comment('montant facture sans la remise');

//                $table->integer('user_id')->unsigned() ;
//                $table->foreign('user_id')->references('id')->on('users');
            
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id')->references('id')->on('clients');
            
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
        Schema::dropIfExists('ventes');
    }
}
