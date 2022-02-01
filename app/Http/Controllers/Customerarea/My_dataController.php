<?php

namespace App\Http\Controllers\Customerarea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\CustomerService;
use Auth;

class My_dataController extends Controller
{   
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        parent::__construct();

        $this->customerService = $customerService;
    }

    public function show()
    {
        $customer = $this->customerService->find(Auth::guard('customer')->user()->customer_id);

        if(empty($customer)) {
            abort(404);
        }

        return view('customerarea.my-data.show', [
            'bodyClass' => 'customer',
            'allTypes'  => $this->customerService->allTypes(),
            'my_data'   => $customer,
        ]);
    }

    public function update(UpdateCustomerRequest $request)
    {
        try {

            $this->customerService->update((!empty($request->input('password'))) ? $request->except([]) : $request->except(["password"]), Auth::guard('customer')->user()->customer_id);

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro atualizado com sucesso!"));
            return redirect(route("customerarea-my-data"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("customerarea-my-data"));
        }           
    }
}
