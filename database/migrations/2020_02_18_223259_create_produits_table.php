<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('designationProduit')->unique();
            $table->integer('conditionnementProduit');
            $table->string('caracteristiqueProduit')->nullable();
            $table->timestamps();
            
//            $table->integer('users_id')->unsigned();
//            $table->foreign('users_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('produits');
    }
}
