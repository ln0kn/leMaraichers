<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCalibre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calibre');
            $table->integer('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits');
            
//            $table->integer('users_id')->unsigned();
//            $table->foreign('users_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('calibres');
    }
}
