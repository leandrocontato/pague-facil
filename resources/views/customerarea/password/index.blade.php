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
                    <div class="auth-brand text-center text-lg-start mb-4" >
                        <a href="{!!route('customerarea-auth')!!}">
                            <span>
                            	<img src="{!!secure_asset('img/pague-facil.png')!!}" alt="Pague Fácil">
                            </span>
                        </a>
                    </div>
                    <p class="text-muted mb-4">
	                    Digite seu endereço de e-mail para recuperar sua senha
	                </p>
                    @include('layout.alert')
                    {!!Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['recovery-password', http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                        <div class="mb-3">
                            {!!Form::label('email', 'Email')!!}
                            {!!Form::text('email', null, ['class' => 'form-control',  'required'])!!}
                            @if (!empty($errors->first('email')))
                                <label class="invalid-feedback d-block">{!!$errors->first('email')!!}</label> 
                            @endif  
                        </div>
                        <div class="d-grid gap-2">
                            {!!Form::button('Recuperar', ['class' => 'btn btn-primary py-2', 'type' => 'submit']);!!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center"></div>
    </div>
@endsection
@section('script')   
    <script src="{{secure_asset('js/customerarea-auth.js')}}"></script> 
@endsection