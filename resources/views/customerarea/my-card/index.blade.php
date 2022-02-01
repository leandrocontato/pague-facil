@extends('layout.app')
@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/customerarea.css') }}">
@endsection
@section('title')
    Meu Cartão - Pague Fácil
@endsection
@section('content')
    <div class="wrapper">
        @include('customerarea.includes.sidebar')
        <div class="content-page">
            <div class="content">
                @include('customerarea.includes.header')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                                        aria-label="breadcrumb">
                                        <ol class="breadcrumb my-4">
                                            <li class="breadcrumb-item">
                                                <a href="{!! route('customerarea-home') !!}">
                                                <i title="Inicio" class="fa fa-home"></i> Inicio</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Adicionar um cartão</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            @include('layout.alert')
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    {!! Form::model($my_card, ['method' => 'post', 'autocomplete' => false, 'route' => ['customerarea-my-card-save', $my_card->customer_id, http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row d-none type-jury"> 
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('number_card', 'Numero do cartao') !!}
                                                    {!! Form::text('number_card', null, ['class' => 'form-control', 'id' => 'number_card', 'maxlength' => '16', 'name' => 'number_card', 'required']) !!}
                                                    @if (!empty($errors->has('number_card')))
                                                        <label class="invalid-feedback d-block">{!! $errors->first('number_card') !!}</label>
                                                    @endif
                                                        <label class="invalid-feedback d-none" id="number_card_validate"></label>
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('code_card', 'Código de Segurança (CVV)') !!}
                                                    {!! Form::text('code_card', null, ['class' => 'form-control', 'maxlength' => '3', 'required']) !!}
                                                    @if (!empty($errors->first('code_card')))
                                                        <label class="invalid-feedback d-block">{!! $errors->first('code_card') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('card_expiry_date', 'Data de vencimento do cartao') !!}
                                                    {!! Form::text('card_expiry_date', null, ['class' => 'form-control', 'id' => 'validade', 'required']) !!}
                                                    @if (!empty($errors->first('card_expiry_date')))
                                                        <label class="invalid-feedback d-block">{!! $errors->first('card_expiry_date') !!}</label>
                                                    @endif
                                                        <label class="invalid-feedback d-none" id="card_expery_date_validate"></label>
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('cardholder_name', 'Nome do titular') !!}
                                                    {!! Form::text('cardholder_name', null, ['class' => 'form-control', 'required']) !!}
                                                    @if (!empty($errors->first('cardholder_name')))
                                                        <label class="invalid-feedback d-block">{!! $errors->first('cardholder_name') !!}</label>
                                                    @endif
                                                </div>
                                                <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    {!! Form::label('identidade_customer', 'CPF/CNPJ do titular') !!}
                                                    {!! Form::text('identidade_customer', null, ['class' => 'form-control', 'id' => 'cpfcnpj', 'required']) !!}
                                                    @if (!empty($errors->first('identidade_customer')))
                                                        <label class="invalid-feedback d-block">{!! $errors->first('identidade_customer') !!}</label>
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
            @include('customerarea.includes.footer')
        </div>
    </div>
    @endsection
    @section('script') 
    <script src="{{ asset('js/customerarea.js') }}"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.js " ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous"></script>
    <script>      
            
                       
    </script>
    @endsection