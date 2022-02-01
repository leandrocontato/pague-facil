@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/dashboard.css') }}">
@endsection

@section('title')
    {!! isset($customer) ? 'Editar' : 'Novo' !!} Cliente - Pague Fácil
@endsection

@section('content')
    <div class="wrapper">
        @include('dashboard.includes.sidebar')
        <div class="content-page">
            <div class="content">
                @include('dashboard.includes.header')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                                        aria-label="breadcrumb">
                                        <ol class="breadcrumb my-4">
                                            <li class="breadcrumb-item">
                                                <a href="{!! route('dashboard-home') !!}"><i title="Inicio"
                                                        class="fa fa-home"></i> Inicio</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{!! route('dashboard-customer') !!}">Clientes</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page"> {!! isset($customer) ? 'Editar' : 'Novo' !!}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    @if (isset($customer))
                                        {!! Form::model($customer, ['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard-customer-update', $customer->customer_id, http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                                    @else
                                        {!! Form::open(['method' => 'post', 'autocomplete' => false, 'route' => ['dashboard-customer-create', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                                    @endif
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    {!! Form::label('type', 'Tipo de Cadastro') !!}
                                                    {!! Form::select('type', $allTypes, null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('type')))
                                                        <label class="invalid-feedback">{!! $errors->first('type') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row d-none type-physical">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('first_name', 'Nome') !!}
                                                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('first_name')))
                                                        <label class="invalid-feedback">{!! $errors->first('first_name') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('last_name', 'Sobrenome') !!}
                                                    {!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('last_name')))
                                                        <label class="invalid-feedback">{!! $errors->first('last_name') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('cpf', 'CPF') !!}
                                                    {!! Form::text('cpf', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('cpf')))
                                                        <label class="invalid-feedback">{!! $errors->first('cpf') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row d-none type-jury">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('company_name', 'Razão Social') !!}
                                                    {!! Form::text('company_name', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('company_name')))
                                                        <label class="invalid-feedback">{!! $errors->first('company_name') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('fantasy_name', 'Nome Fantasia') !!}
                                                    {!! Form::text('fantasy_name', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('fantasy_name')))
                                                        <label class="invalid-feedback">{!! $errors->first('fantasy_name') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('cnpj', 'CNPJ') !!}
                                                    {!! Form::text('cnpj', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('cnpj')))
                                                        <label class="invalid-feedback">{!! $errors->first('cnpj') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                                    {!! Form::label('address', 'Endereço') !!}
                                                    {!! Form::text('address', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('address')))
                                                        <label class="invalid-feedback">{!! $errors->first('address') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('number', 'Numero') !!}
                                                    {!! Form::text('number', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('number')))
                                                        <label class="invalid-feedback">{!! $errors->first('number') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('complement', 'Complemento') !!}
                                                    {!! Form::text('complement', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('complement')))
                                                        <label class="invalid-feedback">{!! $errors->first('complement') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('neighoarhood', 'Bairro') !!}
                                                    {!! Form::text('neighoarhood', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('neighoarhood')))
                                                        <label class="invalid-feedback">{!! $errors->first('neighoarhood') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('cep', 'CEP') !!}
                                                    {!! Form::text('cep', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('cep')))
                                                        <label class="invalid-feedback">{!! $errors->first('cep') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('countrie_id', 'Pais') !!}
                                                    {!! Form::select('countrie_id', [], null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required', 'disabled' => true, 'data-active' => isset($customer) ? $customer->countrie_id : old('countrie_id')]) !!}
                                                    @if (!empty($errors->first('countrie_id')))
                                                        <label class="invalid-feedback">{!! $errors->first('countrie_id') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('state_id', 'Estado') !!}
                                                    {!! Form::select('state_id', [], null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required', 'disabled' => true, 'data-active' => isset($customer) ? $customer->state_id : old('state_id')]) !!}
                                                    @if (!empty($errors->first('state_id')))
                                                        <label class="invalid-feedback">{!! $errors->first('state_id') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('citie_id', 'Cidade') !!}
                                                    {!! Form::select('citie_id', [], null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required', 'disabled' => true, 'data-active' => isset($customer) ? $customer->citie_id : old('citie_id')]) !!}
                                                    @if (!empty($errors->first('citie_id')))
                                                        <label class="invalid-feedback">{!! $errors->first('citie_id') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('phone', 'Telefone') !!}
                                                    {!! Form::text('phone', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('phone')))
                                                        <label class="invalid-feedback">{!! $errors->first('phone') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('cellphone', 'Celular') !!}
                                                    {!! Form::text('cellphone', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('cellphone')))
                                                        <label class="invalid-feedback">{!! $errors->first('cellphone') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('accredited', 'É um credenciado?') !!}
                                                    {!! Form::select('accredited', $allAccredited, null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('accredited')))
                                                        <label class="invalid-feedback">{!! $errors->first('accredited') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('email', 'Email') !!}
                                                    {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('email')))
                                                        <label class="invalid-feedback">{!! $errors->first('email') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('password', 'Senha') !!}
                                                    {!! Form::password('password', ['class' => 'form-control', 'required', 'autocomplete' => 'false']) !!}
                                                    @if (!empty($errors->first('password')))
                                                        <label class="invalid-feedback">{!! $errors->first('password') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('status', 'Situação') !!}
                                                    {!! Form::select('status', $allStatus, null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('status')))
                                                        <label class="invalid-feedback">{!! $errors->first('status') !!}</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            {!! Form::button('<i class="fas fa-check"></i> Salvar', ['class' => 'btn btn-sm btn-primary py-2', 'type' => 'submit']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.includes.footer')
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ secure_asset('js/dashboard.js') }}"></script>
@endsection
