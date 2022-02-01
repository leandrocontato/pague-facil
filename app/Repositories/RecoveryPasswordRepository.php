<?php

namespace App\Repositories;
use App\Models\Password;

class RecoveryPasswordRepository
{
    protected $password;

    public function __construct(Password $password)
    {
        $this->password = $password;
    }
    
    public function findToken($token){
       
        return $this->password->where('token', $token);
    }

}