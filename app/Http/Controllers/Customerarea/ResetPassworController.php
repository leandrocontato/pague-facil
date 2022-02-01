<?php

namespace App\Http\Controllers\Customerarea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Services\RecoveryPasswordService;
use App\Http\Requests\UpdateLostPasswordRequest;
use Illuminate\Support\Facades\Password;

class ResetPassworController extends Controller
{
	use ResetsPasswords;

    protected $recoveryPassword;
    public function __construct(RecoveryPasswordService $recoveryPassword){
        $this->recoveryPassword = $recoveryPassword;
    }


    public function index(Request $request)
    {  
        
        $consultaToken = $this->verifyToken($request->input('token'));
        if ($consultaToken == null){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Token inexistente, por favor, refaça o procedimento']);
            return redirect()->route('lost-password');
        }

        return view('customerarea.password.resetPassword', ['bodyClass' => 'customer']);
    }

    public function verifyToken($token){
        $consultaToken = $this->recoveryPassword->findToken($token);
        if (empty($consultaToken)){
           return null;
        } else {
            return true;
        }

    }

    public function update(UpdateLostPasswordRequest $requestPassword)
    {  

        $credentials = $requestPassword->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );

            $response = Password::broker('customer')->reset($credentials, function($user, $password) {
            $user->password = $password;
            $user->save();
            \Auth::guard('customer')->login($user);
        }); 

       
        switch ($response)
        {   

            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                session()->flash('alert', array('code'=> 'danger', 'text'  => 'Token ou usuário inexistente.'));
                return redirect(route('lost-password', http_build_query($requestPassword->except(["password", "_token", "password_confirmation", "email"])))); 

            case Password::PASSWORD_RESET:
                return redirect()->route('customerarea-home');
        }

        session()->flash('alert', array('code'=> 'danger', 'text'  => "Não conseguimos alterar sua senha. Tente novamente!"));
        return redirect(route('lost-password', http_build_query($requestPassword->except(["password", "_token", "password_confirmation", "email"]))));  

    }
}