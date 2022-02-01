@extends('layout.app')

@section('style')	
	<link rel="stylesheet" href="{{secure_asset('css/dashboard.css')}}"> 
@endsection

@section('title')
	Paises - Pague Fácil 
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
                                    <li class="breadcrumb-item active" aria-current="page"> Paises</li>
                                  </ol>
                                </nav>
                            </div>
                        </div>                        
                        @include('layout.alert') 
                        <div class="row">
                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                {!!Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['dashboard-countrie', http_build_query(Request::input())], 'class' => ($errors->any()) ? 'was-validated': '' ,'novalidate'])!!}               
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="my-2 col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                    {!!Form::label('name', 'Nome')!!}
                                                    {!!Form::text('name', null, ['class' => 'form-control',  'required'])!!}
                                                    @if(!empty($errors->first('name')))
                                                        <label class="invalid-feedback">{!!$errors->first('name')!!}</label>   
                                                    @endif  
                                                </div> 
                                                <div class="my-2 col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                    {!!Form::label('status', 'Situação')!!}
                                                    {!!Form::select('status', $allStatus,  null, ['placeholder' => 'Selecione', 'class' => 'form-control',  'required'])!!}
                                                    @if (!empty($errors->first('status')))
                                                        <label class="invalid-feedback">{!!$errors->first('phone')!!}</label>   
                                                    @endif  
                                                </div>       
                                            </div> 
                                        </div>
                                        <div class="card-footer text-end">
                                             {!!Form::button('<i class="fas fa-search"></i> Buscar', ['class' => 'btn btn-sm btn-primary my-1 py-2', 'type' => 'submit']);!!}
                                             <a href="{!!route('dashboard-countrie-create')!!}" class="btn btn-sm btn-secondary my-1 py-2"><i class="fas fa-plus"></i> Novo</a>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                          <th>Código</th>
                                                          <th>Nome</th>
                                                          <th>Sigla</th>
                                                          <th>Situação</th>
                                                          <th>Ações</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!$countries->isEmpty())
                                                            @foreach ($countries as $countrie)
                                                                <tr>
                                                                    <td data-label="Código">{!!$countrie->countrie_id!!}</td>
                                                                    <td data-label="Nome">{!!Str::limit($countrie->name, 80)!!}</td>
                                                                    <td data-label="Sigla">{!!$countrie->initial!!}</td>
                                                                    <td data-label="Situação">{!!$countrie->status()!!}</td>
                                                                    <td data-label="Ações">
                                                                        <a href="{!!route('dashboard-countrie-update', $countrie->countrie_id)!!}" class="btn btn-sm btn-primary">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="{!!route('dashboard-countrie-delete', $countrie->countrie_id)!!}" class="btn btn-sm btn-danger btn-delete">
                                                                            <i class="fa fa-trash-alt"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                           @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5" align="center">
                                                                   <div class="alert alert-warning mb-0" role="alert">
                                                                        Não há paises cadastrados!
                                                                   </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($countries->hasPages())
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                          {!!$countries->appends(Request::input())->render()!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif                        
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