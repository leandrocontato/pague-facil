<?php

namespace App\Services;
use App\Repositories\ResetDadosRepository;

class ResetDadosService
{   
    protected $resetDadosRepository;

    public function __construct(ResetDadosRepository $resetDadosRepository)
    {
        $this->resetDadosRepository = $resetDadosRepository;
    }

    public function create($data) {
        return $this->resetDadosRepository->create($data);
    }

    public function update($email, $data){
        return $this->resetDadosRepository->update($email, $data);
    }

    public function findEmail($email){
        return $this->resetDadosRepository->findEmail($email);
    }

    public function findToken($token){
        return $this->resetDadosRepository->findToken($token);
    }

    public function deleteToken($token){
        return $this->resetDadosRepository->deleteToken($token);
    }

   
}
