<?php

namespace App\Services;
use App\Repositories\RecoveryPasswordRepository;

class RecoveryPasswordService
{   
    protected $recoveryCustomerRepository;

    public function __construct(RecoveryPasswordRepository $recoveryCustomerRepository)
    {
        $this->recoveryCustomerRepository = $recoveryCustomerRepository;
    }

    public function create($data) {
        return $this->recoveryCustomerRepository->create($data);
    }

    public function find($email){
        return $this->recoveryCustomerRepository->find($email);
    }
    
    public function findToken($token){
        return $this->recoveryCustomerRepository->findToken($token);
    }
}
