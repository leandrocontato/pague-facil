<?php

namespace App\Http\Controllers\Customerarea;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Services\RecoveryPasswordService;
use App\Http\Requests\StoreLostPasswordRequest;
use Illuminate\Support\Facades\Password;
use Mail; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class LostpassworController extends Controller
{

    protected $customerService;
    protected $recoveryService;
    public function __construct(CustomerService $customerService, RecoveryPasswordService $recoveryService){
        $this->customerService = $customerService;
        $this->recoveryService = $recoveryService;
    }


    public function index(){
        return view('customerarea.password.index', ['bodyClass' => 'customer']);
    }

    public function store(StoreLostPasswordRequest $request)
    {

        $consulta = $this->customerService->emailCustomer($request->email);

        if (empty($consulta)){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => "E-mail <b>{$request->email}</b> não existe"]);
            return redirect()->route('lost-password');
        }

        $request->session()->flash('emailExiste');

        $response = Password::broker('customer')->sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT){ 
            return redirect()->route('emailEnviado');
        } else {
            $request->session()->flash('alert', ['code' => 'danger', 'text' => "Não foi possível enviar o e-mail"]);
            return redirect()->route('lost-password');
        }
    }


    public function show(Request $request){

        if ($request->session()->has('emailExiste')){
             return view('customerarea.password.sucesso', ['bodyClass' => 'customer']);
        } else {
                return redirect()->route('lost-password');
        }
    }

    public function showEmail(){
        return view('customerarea.password.email');
    }

}
