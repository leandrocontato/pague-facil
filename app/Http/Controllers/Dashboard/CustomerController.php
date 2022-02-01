<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\CustomerService;
use App\Services\CardService;
use Symfony\Component\VarDumper\Cloner\Data;

class CustomerController extends Controller
{   
    protected $customerService;
    protected $cardService;

    public function __construct(CustomerService $customerService, CardService $cardService)
    {
        parent::__construct();

        $this->customerService = $customerService;
        $this->cardService      = $cardService;
    }

    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'customer_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dashboard.customer.index', [
            'bodyClass' => 'customer',
            'customers' => $this->customerService->list($request, $orderByField, $orderByOrder , $paginate),
            'allStatus' => $this->customerService->allStatus()
        ]);
    }

    public function create()
    {
        return view('dashboard.customer.show', [
            'bodyClass'     => 'customer',
            'allStatus'     => $this->customerService->allStatus(),
            'allTypes'      => $this->customerService->allTypes(),
            'allAccredited' => $this->customerService->allAccredited()
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $this->customerService->create($request->all());
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro realizado com sucesso!"));
            return redirect(route("dashboard-customer"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-customer"));
        }
    }

    public function show($customer_id)
    {
        $customer = $this->customerService->find($customer_id);

        if(empty($customer)) {
            abort(404);
        }
        
        return view('dashboard.customer.index', [
            'bodyClass'     => 'customer',
            'allStatus'     => $this->customerService->allStatus(),
            'allTypes'      => $this->customerService->allTypes(),
            'allAccredited' => $this->customerService->allAccredited(),
            'customer'      => $customer,
        ]);
    }

    public function update(UpdateCustomerRequest $request, $customer_id)
    {
        try {

            $this->customerService->update((!empty($request->input('password'))) ? $request->except([]) : $request->except(["password"]), $customer_id);

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro atualizado com sucesso!"));
            return redirect(route("dashboard-customer"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-customer"));
        }           
    }

    public function destroy(Request $request, $customer_id)
    {
        try {
            $this->customerService->destroy($customer_id);
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Registro excluido com sucesso!'));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));              
        }

        return redirect(route("dashboard-customer"));    
    }

}
