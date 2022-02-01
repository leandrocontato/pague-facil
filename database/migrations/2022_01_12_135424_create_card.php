<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('card', function (Blueprint $table) {
            $table->id('card_id');
            $table->string('flag_card');
            $table->string('number_card')->unique();
            $table->integer('code_card');
            $table->string('card_expiry_date', 15);
            $table->string('cardholder_name');
            $table->integer('customer_id');
            $table->string('cpf_cnpj_customer');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('card');
    }
}
