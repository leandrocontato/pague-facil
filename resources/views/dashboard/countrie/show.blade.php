@extends('layout.app')

@section('style')	
	<link rel="stylesheet" href="{{secure_asset('css/dashboard.css')}}"> 
@endsection

@section('title')
	{!!isset($countrie) ? "Editar" : "Novo" !!} Pais - Pague Fácil 
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
                                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                  <ol class="breadcrumb my-4">
                                    <li class="breadcrumb-item">
                                        <a href="{!!route('dashboard-home')!!}"><i title="Inicio" class="fa fa-home"></i>  Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item"> Configurações</li>
                                    <li class="breadcrumb-item">
                                        <a href="{!!route('dashboard-countrie')!!}">Paises</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"> {!!isset($countrie) ? "Editar" : "Novo" !!}</li>
                                  </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                @if (isset($countrie))
                                    {!!Form::model($countrie, ['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard-countrie-update', $countrie->countrie_id, http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                                @else
                                    {!!Form::open(['method' => 'post', 'autocomplete' => false, 'route' => ['dashboard-countrie-create', http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                                @endif
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                    {!!Form::label('name', 'Nome')!!}
                                                    {!!Form::text('name', null, ['class' => 'form-control',  'required'])!!}
                                                    @if (!empty($errors->first('name')))
                                                        <label class="invalid-feedback">{!!$errors->first('name')!!}</label>   
                                                    @endif  
                                                </div> 
                                                <div class="my-2 col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                    {!!Form::label('initial', 'Sigla')!!}
                                                    {!!Form::text('initial', null, ['class' => 'form-control',  'required'])!!}
                                                    @if (!empty($errors->first('initial')))
                                                        <label class="invalid-feedback">{!!$errors->first('initial')!!}</label>   
                                                    @endif  
                                                </div> 
                                            </div> 
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    {!!Form::label('status', 'Situação')!!}
                                                    {!!Form::select('status', $allStatus,  null, ['placeholder' => 'Selecione', 'class' => 'form-control',  'required'])!!}
                                                    @if (!empty($errors->first('status')))
                                                        <label class="invalid-feedback">{!!$errors->first('status')!!}</label>   
                                                    @endif  
                                                </div>   
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                             {!!Form::button('<i class="fas fa-check"></i> Salvar', ['class' => 'btn btn-sm btn-primary py-2', 'type' => 'submit']);!!}
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
    <script src="{{secure_asset('js/dashboard.js')}}"></script> 
@endsection