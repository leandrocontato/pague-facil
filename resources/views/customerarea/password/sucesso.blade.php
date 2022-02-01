@extends('layout.app')

@section('style')	
	<link rel="stylesheet" href="{{secure_asset('css/customerarea-auth.css')}}"> 
@endsection

@section('title')
	Login - Pague Fácil 
@endsection

@section('content')	
	<div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <div class="auth-brand text-center mb-4" >
                        <a href="{!!route('customerarea-auth')!!}">
                            	<img style="" src="{!!asset('img/password-reset.png')!!}" alt="Pague Fácil">
                        </a>
                    </div>
                    <h2 style="color: #3B0172 !important;font-weight: bold;font-size: 20px;text-align: center;" class="text-muted mb-4"> E-mail enviado com sucesso</h2>
                    <p class="text-muted mb-4 text-center">
	                    Por favor, verifique seu e-mail e siga as instruções de redefinição.
	                </p>
                    <div class="d-grid gap-2">
                       <button onclick="window.location='{{route('customerarea-auth')}}'" class="btn btn-danger py-2" style="background:#EF7806 !important; border:none !important; border-radius:10px !important; padding:15px !important; "> Entendi </button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center"></div>
    </div>
@endsection
@section('script')   
    <script src="{{secure_asset('js/customerarea-auth.js')}}"></script> 
@endsection