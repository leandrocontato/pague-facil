@extends('layout.app')

@section('style')	
	<link rel="stylesheet" href="{{secure_asset('css/dashboard.css')}}"> 
@endsection

@section('title')
	Dashboard - Pague Fácil 
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
                                  </ol>
                                </nav>
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