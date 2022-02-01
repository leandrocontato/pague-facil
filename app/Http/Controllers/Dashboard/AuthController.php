<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use Auth;

class AuthController extends Controller
{   

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('dashboard.auth.index', [
            'bodyClass' => 'auth'
        ]);
    }

    public function store(AuthUserRequest $request)
    {
        try {

            $credentials           = $request->only('email', 'password');
            $credentials['status'] = true;

            if (!Auth::guard('dashboard')->attempt($credentials, $request->input('remember'))) {
                $request->session()->flash('alert', array('code'=> 'danger', 'text'  => "Acesso não autorizado!"));
                return redirect(route("dashboard-auth"));
            }

            return redirect(route("dashboard-home"));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-auth"));
        }  
    }

    public function logout(Request $request)
    {
        try {

            Auth::guard('dashboard')->logout();
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Você foi desconectado!'));
           
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
        } 

        return redirect(route("dashboard-auth"));
    }
}
