<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citie extends Model
{
	use SoftDeletes;

    protected $table      = "citie";
	protected $primaryKey = 'citie_id';
	protected $fillable   = [
		'name', 
		'status', 
		'state_id', 
		'cd_ibge', 
		'created_at', 
		'updated_at',
		'deleted_at'
	];

	protected $appends    = [
		'title'
	];

    public function getTitleAttribute()
    { 
        return $this->name.' - '.$this->state->initial;
    }

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
        return $this->hasOne('App\Models\State', 'state_id', 'state_id');
    }
}
