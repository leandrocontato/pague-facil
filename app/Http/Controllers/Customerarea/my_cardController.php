<?php

namespace App\Http\Controllers\Customerarea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customerarea\Exception;
use App\Services\CardService;
use App\Http\requests\StoreCardRequest;

class My_cardController extends Controller
{   
    protected $customerService;
    protected $cardService;

    public function __construct(CustomerService $customerService, CardService $cardService)
    {
        parent::__construct();

        $this->customerService = $customerService;
        $this->cardService     = $cardService;
    }

    public function index()
    {
        $customer = $this->customerService->find(Auth::guard('customer')->user()->customer_id);

        if(empty($customer)) {
            abort(404);
        }

        return view('customerarea.my-card.index', [
            'bodyClass' => 'customer',
            'allTypes'  => $this->customerService->allTypes(),
            'my_card'   => $customer,
        ]);
    }

    public function store(StoreCardRequest $request, $customer_id){

        $user = $this->customerService->find($customer_id);
        if (empty($user)){
            abort(404);
        }

        $data = [
            'flag_card'         => $request->flag_card,
            'cardholder_name'   => $request->cardholder_name,
            'number_card'       => $request->number_card,
            'code_card'         => $request->code_card,
            'card_expiry_date'  => $request->card_expiry_date,
            'cpf_cnpj_customer' => $request->identidade_customer,
            'customer_id'       => $request->customer_id,            
        ];

    
        if($this->cardService->create($data)){
            $request->session()->flash('alert', ["code" => "success", "text" => "Cartão adicionado com sucesso"]);
            return redirect()->route('customerarea-my-card');
        } else {
            return false;
        }        
    }

    public function show(){
        $consulta = $this->cardService->findIdCustomer(Auth::guard('customer')->user()->customer_id);
        return view('customerarea.my-card.show', ["cartoes" => $consulta]);
    }

    public function delete(Request $request, $id_card){

        $deleteCard = $this->cardService->destroy($id_card);

        if ($deleteCard){
            $request->session()->flash('alert', ["code" => "success", "text" => "Cartão removido com sucesso"]);
            return redirect()->route('my-cards');
        } else {
            return false;
        }
    }
}
