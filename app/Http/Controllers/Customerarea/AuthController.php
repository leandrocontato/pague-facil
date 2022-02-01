<?php

namespace App\Http\Controllers\Customerarea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthCustomerRequest;
use Auth;

class AuthController extends Controller
{   

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('customerarea.auth.index', [
            'bodyClass' => 'auth'
        ]);
    }

    public function store(AuthCustomerRequest $request)
    {
        try {

            $credentials           = $request->only('email', 'password');
            $credentials['status'] = true;

            if (!Auth::guard('customer')->attempt($credentials, $request->input('remember'))) {
                $request->session()->flash('alert', array('code'=> 'danger', 'text'  => "Acesso não autorizado!"));
                return redirect(route("customerarea-auth"));
            }

            return redirect(route("customerarea-home"));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("customerarea-auth"));
        }  
    }

    public function logout(Request $request)
    {
        try {

            Auth::guard('customer')->logout();
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Você foi desconectado!'));
           
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
        } 

        return redirect(route("customerarea-auth"));
    }
}
