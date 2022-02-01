@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/customerarea-auth.css') }}">
@endsection

@section('title')
    Login - Pague Fácil
@endsection

@section('content')
    <div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <div class="auth-brand text-center text-lg-start mb-4">
                        <a href="{!! route('customerarea-auth') !!}">
                            <span>
                                <img src="{!! secure_asset('img/pague-facil.png') !!}" alt="Pague Fácil">
                            </span>
                        </a>
                    </div>
                    <p class="text-muted mb-4">
                        Digite seu endereço de e-mail e senha para acessar a sua conta.
                    </p>
                    @include('layout.alert')
                    {!!Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['customerarea-auth', http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                        <div class="mb-3">
                            {!!Form::label('email', 'Email')!!}
                            {!!Form::text('email', null, ['class' => 'form-control',  'required'])!!}
                            @if (!empty($errors->first('email')))
                                <label class="invalid-feedback d-block">{!!$errors->first('email')!!}</label>   
                            @endif  
                        </div>
                        <div class="mb-3">
                            <a href="{{route('lost-password')}}" class="text-muted float-end"><small>Esqueceu sua senha?</small></a>
                            {!!Form::label('password', 'Senha')!!}
                            {!!Form::password('password', ['class' => 'form-control',  'required'])!!}
                            @if (!empty($errors->first('password')))
                                <label class="invalid-feedback d-block">{!!$errors->first('password')!!}</label>   
                            @endif 
                        </div>
                        <div class="mb-3">
                            {!!Form::checkbox('remember', TRUE, null, ['class' => 'form-check-input', 'id' => 'remember'])!!}                                    
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
        <div class="auth-fluid-right text-center"></div>
    </div>
@endsection
@section('script')
    <script src="{{ secure_asset('js/customerarea-auth.js') }}"></script>
@endsection
