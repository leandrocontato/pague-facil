<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetDados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_dados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email_antigo', 80);
            $table->string('email_novo', 80);
            $table->string('password', 255)->nullable();
            $table->string('token', 255);
            $table->integer('id_costumer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reset_dados');
    }
}
