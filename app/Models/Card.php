<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
	use SoftDeletes;

    protected $table      = "card";
	protected $primaryKey = 'card_id';
	
	protected $fillable   = [
		'flag_card', 
		'number_card', 
		'code_card', 
		'card_expiry_date',
		'cardholder_name',
		'customer_id',
		'cpf_cnpj_customer', 
		'created_at', 
		'updated_at',
		'deleted_at'
	];
}
