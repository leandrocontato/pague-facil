<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->integer('type')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('fantasy_name')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
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
            $table->integer('accredited')->unsigned();
            $table->integer('status')->unsigned();
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
        Schema::dropIfExists('customer');
    }
}
