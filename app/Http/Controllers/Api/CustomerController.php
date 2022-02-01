<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\http\Requests\UpdateCustomerRequest;
use App\http\Requests\UpdatePartialCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;
use App\Services\ResetDadosService;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    protected $customerService;
    protected $resetDados;

    public function __construct(CustomerService $customerService, ResetDadosService $resetDados)
    {
        $this->customerService = $customerService;
        $this->resetDados      = $resetDados;
    }
    
    /**
     * @OA\GET(
     *     tags={"Clientes"},
     *     summary="Lista os clientes",
     *     description="Retorna a coleção de clientes",
     *     path="/customer",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'customer_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return new CustomerResource($this->customerService->list($request, $orderByField, $orderByOrder , $paginate));
    }

    /**
     * @OA\POST(
     *     tags={"Clientes"},
     *     summary="Criação de cliente",
     *     description="Retorna a coleção do cliente criado",
     *     path="/customer",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource($this->customerService->create($request->all()));
    }

    /**
     * @OA\GET(
     *     tags={"Clientes"},
     *     summary="Lista um cliente",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/{customer_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show(Request $request,  $customer_id)
    {
        return new CustomerResource($this->customerService->find($customer_id));
    }

    /**
     * @OA\PUT(
     *     tags={"Clientes"},
     *     summary="Atualiza um cliente",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/{customer_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update(UpdateCustomerRequest $request, $customer_id)
    {
        return new CustomerResource($this->customerService->update($request->all(), $customer_id));
    }

    /**
     * @OA\DELETE(
     *     tags={"Clientes"},
     *     summary="Exclui um cliente",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/{customer_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function destroy($customer_id)
    {
        return new CustomerResource($this->customerService->destroy($customer_id));
    }

    /**
     * @OA\GET(
     *     tags={"Clientes"},
     *     summary="Lista os dados do cliente autênticado",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/me",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show_me(Request $request)
    {
        return new CustomerResource($this->customerService->find($request->user()->customer_id));
    }  

    /**
     * @OA\PUT(
     *     tags={"Clientes"},
     *     summary="Atualiza os dados do cliente autênticado",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/me",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update_me(UpdateCustomerRequest $request)
    {
        return new CustomerResource($this->customerService->update($request->except(['customer_id', 'status']), $request->user()->customer_id));
    }  

     /**
     * @OA\PUT(
     *     tags={"Clientes"},
     *     summary="Atualiza os dados de acesso do cliente autênticado",
     *     description="Retorna a coleção do cliente",
     *     path="/customer/me/credential",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update_me_partial(UpdatePartialCustomerRequest $request)
    {
        return new CustomerResource($this->customerService->update($request->only(['email', 'password']), $request->user()->customer_id));
    } 

    public function change(Request $request){
        
        $token = \Str::random(91);

        // faz a busca do usuário
        $user = $this->customerService->find($request->customer_id);
         if (empty($user)){
           return new CustomerResource([
               "tipo"   => "danger",
               "text"   => "ID do usuário não encontrado"
           ]);
        }
        /* Verifica se o e-mail já existe na tabela, antes de fazer o procedimento de iserção, caso exista, faço
        uma atualização na BD */

        $consultaEmailTabela = $this->resetDados->findEmail($user->email)->first();
        if (!empty($consultaEmailTabela)){

            $data_email = [
                "token"      => $token,
                "email_novo" => $request->email_novo,
                "id_costumer" => $user->customer_id
            ];

            $request->merge([
                'token' => ''
            ]);

            $this->resetDados->update($user->email, $data_email);

            if ($request->password != null) {
                $user->password = $request->password;
                $user->save();
            }

            \Mail::send('customerarea.password.change-email-password', ['user'=> $user, 'token' => $token], function($message) use($user){
                $message->to($user->email);
                $message->subject('Alteração de dados - Pague Fácil');
            });

            return new CustomerResource([
                "tipo"  => "sucesso",
                "text"  => "Dados alterados com sucesso. Acesse seu e-mail para confirmar a alteração para o e-mail novo"
            ]);
        }

        if ($request->email_novo != $user->email){
           
            $data = [
                'email_antigo' => $user->email,
                'email_novo'   => $request->email_novo,
                'token'        => $token,
                'id_costumer'  => $user->customer_id
            ];

            $this->resetDados->create($data);

            if ($request->password != null) {
                $user->password = $request->password;
                $user->save();
            }

            \Mail::send('customerarea.password.change-email-password', ['user'=> $user, 'token' => $token], function($message) use($user){
                $message->to($user->email);
                $message->subject('Alteração de dados');
            });

            return new CustomerResource([
                "tipo"  => "sucesso",
                "text"  => "Dados alterados com sucesso. Acesse seu e-mail para confirmar a alteração para o e-mail novo"
            ]);

        } else if ($request->email_novo == $user->email){
            
            $user->password = $request->password;
            $user->save();
            
            return new CustomerResource([
                'tipo' => 'sucesso',
                'text' => 'Senha alterada com sucesso'
            ]);
        }
    }
}
