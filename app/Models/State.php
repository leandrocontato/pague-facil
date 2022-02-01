<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
	use SoftDeletes;

    protected $table      = "state";
	protected $primaryKey = 'state_id';
	protected $fillable   = [
		'name', 
		'initial', 
		'status', 
		'cd_ibge', 
		'countrie_id', 
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

	public function citie()
    {
        return $this->hasOne('App\Models\Citie', 'state_id', 'state_id');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\Citie', 'state_id', 'state_id');
    }

	public function countrie()
    {
        return $this->hasOne('App\Models\Countrie', 'countrie_id', 'countrie_id');
    }
}
