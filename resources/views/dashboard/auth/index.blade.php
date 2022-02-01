@extends('layout.app')

@section('style')	
	<link rel="stylesheet" href="{{secure_asset('css/dashboard-auth.css')}}"> 
@endsection

@section('title')
	Login - Pague Fácil 
@endsection

@section('content')	
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-xl-4 col-lg-6 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="{!!route('dashboard-auth')!!}">
                            <span>
                            	<img src="{!!secure_asset('img/pague-facil-login.png')!!}" alt="Pague Fácil" height="30">
                            </span>
                        </a>
                    </div>
                    <div class="card-body p-4">                        
                        <div class="text-center w-75 m-auto">
                            <p class="text-muted mb-4">Digite seu endereço de e-mail e senha para acessar o painel de administração.</p>
                        </div>
                        @include('layout.alert') 
                        {!!Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['dashboard-auth', http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                            <div class="mb-3">
                                {!!Form::label('email', 'Email')!!}
                                {!!Form::text('email', null, ['class' => 'form-control',  'required'])!!}
                                @if (!empty($errors->first('email')))
                                    <label class="invalid-feedback d-block">{!!$errors->first('email')!!}</label>   
                                @endif  
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('lost-password') }}" class="text-muted float-end"><small>Esqueceu sua senha?</small></a>
                                {!!Form::label('password', 'Senha')!!}
                                {!!Form::password('password', ['class' => 'form-control',  'required'])!!}
                                @if (!empty($errors->first('password')))
                                    <label class="invalid-feedback d-block">{!!$errors->first('password')!!}</label>   
                                @endif 
                            </div>
                            <div class="mb-3">
                                {!!Form::checkbox('remember', TRUE, null, ['class' => 'form-check-input', 'id' => "remember"])!!}                                    
                                {!!Form::label('remember', 'Lembre de mim', ['class' => 'form-check-label'])!!}
                                @if (!empty($errors->first('remember')))
                                    <label class="invalid-feedback d-block">{!!$errors->first('remember')!!}</label>   
                                @endif
                            </div>
                            <div class="d-grid gap-2">
                                {!!Form::button('Entrar', ['class' => 'btn btn-primary py-2', 'type' => 'submit']);!!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')   
    <script src="{{secure_asset('js/dashboard-auth.js')}}"></script> 
@endsection