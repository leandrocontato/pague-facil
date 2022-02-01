<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable(); 
            $table->string('password')->nullable();                       
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('cep', 100)->nullable();
            $table->string('neighoarhood')->nullable();           
            $table->integer('countrie_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('citie_id')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('cellphone', 30)->nullable();
            $table->integer('status')->unsigned();
            $table->datetime('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
