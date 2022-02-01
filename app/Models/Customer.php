<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Hash;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $table      = "customer";
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'company_name',
        'fantasy_name',
        'cpf',
        'cnpj',
        'email',
        'password',
        'address',
        'cep',
        'neighoarhood',
        'number',
        'complement',
        'countrie_id',
        'state_id',
        'citie_id',
        'phone',
        'cellphone',
        'accredited',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return ($this->type == 1) ? $this->first_name." ".$this->last_name : $this->fantasy_name;
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Hash::make($password);
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

    public static function allTypes(){

        return ['1' => 'Pessoa Física','2' => 'Pessoa Júridica'];
    }

    public function type(){
        return @$this->allTypes()[$this->type]; 
    }

    public static function allAccredited(){

        return ['1' => 'Sim','2' => 'Não'];
    }

    public function accredited(){
        return @$this->allAccredited()[$this->accredited]; 
    }    
}
