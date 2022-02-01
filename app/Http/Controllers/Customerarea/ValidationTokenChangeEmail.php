<?php

namespace App\Http\Controllers\Customerarea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ResetDadosService;
use App\Http\Resources\ValidationTokenChangeEmailResource;
use App\Services\CustomerService;

class ValidationTokenChangeEmail extends Controller
{
    protected $customerService;
    protected $resetDados;

    public function __construct(CustomerService $customerService, ResetDadosService $resetDados)
    {
        $this->customerService = $customerService;
        $this->resetDados      = $resetDados;
    }

    public function index($token){

        $tokenBD = $this->resetDados->findToken($token);
        
        if (empty($tokenBD)){
            return new ValidationTokenChangeEmailResource([
                "tipo" => "danger",
                "text" => "Token inexistente"
            ]);
        }

        $updateUser = $this->customerService->update(["email" => $tokenBD->email_novo], $tokenBD->id_costumer);
        
        if ($updateUser){
            $this->resetDados->deleteToken($token);
            \Auth::guard('customer')->logout();
            return new ValidationTokenChangeEmailResource([
                "tipo"  => "sucesso",
                "text"  => "Seu e-mail foi alterado com sucesso"
            ]);
        }
    }
}
