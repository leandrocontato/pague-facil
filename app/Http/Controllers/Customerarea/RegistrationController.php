<?php

namespace App\Http\Controllers\Customerarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;
use App\Services\CustomerService;

class RegistrationController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        parent::__construct();

        $this->customerService = $customerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customerarea.customer-registration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request){

        $data = [
            'type'          => $request->type,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'company_name'  => $request->company_name,
            'fantasy_name'  => $request->fantasy_name,
            'cpf'           => $request->cpf,
            'cnpj'          => $request->cnpj,
            'email'         => $request->email,
            'password'      => $request->password,
            'address'       => $request->address,
            'cep'           => $request->cep,
            'neighoarhood'  => $request->neighoarhood,
            'number'        => $request->number,
            'complement'    => $request->complement,
            'countrie_id'   => 1,
            'state_id'      => 1,
            'citie_id'      => 1,
            'phone'         => $request->phone,
            'cellphone'     => $request->cellphone,
            'accredited'    => $request->accredited,
            'status'        => 1  
        ];
    
        if($this->customerService->create($data)){
            $request->session()->flash('alert', ["code" => "success", "text" => "Cliente cadastrado"]);
            return redirect()->route('customerarea-auth');
        } else {
            return false;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
