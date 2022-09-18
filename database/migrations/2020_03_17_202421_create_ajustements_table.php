<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjustementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qunatiteNumerique');
            $table->integer('quantitePhysique');
            
            $table->integer('calibre_id')->nullable()->unsigned();
            $table->foreign('calibre_id')->references('id')->on('calibres');

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
        Schema::dropIfExists('ajustements');
    }
}
