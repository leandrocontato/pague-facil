<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countrie extends Model
{
	use SoftDeletes;

    protected $table      = "countrie";
	protected $primaryKey = 'countrie_id';
	protected $fillable   = [
		'name', 
		'initial', 
		'status', 
		'created_at', 
		'updated_at',
		'deleted_at'
	];

	public static function allStatus() {

        return [
            '1' =>  'Ativo',
            '2' =>  'Inativo'
        ];
    }

    public function status() {

        return @$this->allStatus()[$this->status];
    }    

	public function state()
    {
        return $this->hasOne('App\Models\State', 'countrie_id', 'countrie_id');
    }

	public function states()
    {
        return $this->hasMany('App\Models\State', 'countrie_id', 'countrie_id');
    }
}
