<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citie', function (Blueprint $table) {
            $table->increments('citie_id');
            $table->string('name')->nullable();
            $table->integer('status')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('cd_ibge')->unsigned();
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
        Schema::dropIfExists('citie');
    }
}
