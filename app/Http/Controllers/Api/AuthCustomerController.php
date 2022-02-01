<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\AuthCustomerRequest;
use Hash;

class AuthCustomerController extends Controller
{
    use ApiResponser;

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @OA\Info(title="API Pague Fácil", version="1.0")
     * @OA\POST(
     *     tags={"Clientes"},
     *     summary="Registro público de clientes",
     *     description="Retorna a coleção de dados do cliente registrado",  
     *     path="/auth/customer/register",
     *     @OA\Response(response="200", description="")          
     * )
    */
    public function register(StoreCustomerRequest $request)
    {
        return new CustomerResource($this->customerService->create($request->all()));
    }

    /**
     * @OA\POST(
     *     tags={"Clientes"},
     *     summary="Autênticação do cliente",
     *     description="Retorna o token de acesso",  
     *     path="/auth/customer",
     *     @OA\Response(response="200", description="clientes")
     * )
    */
    public function login(AuthCustomerRequest $request)
    {
        if (!Auth::guard('customer')->attempt($request->all())) {
            return $this->error('Dados de acesso inválido', 401);
        }

        return new CustomerResource([
            "token" => Auth::guard('customer')->user()->createToken("customer:".$request->input('email'))->plainTextToken
        ]);
    }

    /**
     * @OA\POST(
     *     tags={"Clientes"},
     *     summary="Logout do cliente",
     *     description="Retorna a mensagem ao usuário",
     *     path="/auth/customer/logout",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function logout(Request $request)
    {
        Auth::guard('apicustomer')->user()->tokens()->delete();

        return new CustomerResource(['message' => 'Você foi desconectado com sucesso!']);
    }  
}
