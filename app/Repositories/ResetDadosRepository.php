<?php

namespace App\Repositories;
use App\Models\ResetDados;

class ResetDadosRepository
{
    protected $resetDados;

    public function __construct(ResetDados $resetDados)
    {
        $this->resetDados = $resetDados;
    }

    public function create($data){
        return $this->resetDados->create($data);
    }

    public function update($email, $data){
        //return dd($this->resetDados->where('email_antigo', 'josealves@boahost.com.br')->first());

        return $this->resetDados->where('email_antigo', $email)->update($data);
    }

    public function findEmail($email){
        return $this->resetDados->where('email_antigo', $email);
    }

    public function findToken($token){
        return $this->resetDados->where('token', $token)->first();
    }

    public function deleteToken($token){
        return $this->resetDados->where('token', $token)->delete();
    }

}
