@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/customerarea.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/dashboard.css') }}">
@endsection

@section('title')
    Meu Cartão - Pague Facil
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
                                                <a href="{!! route('customerarea-home') !!}"><i title="Inicio"
                                                        class="fa fa-home"></i> Inicio</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Meus Cartões</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            @include('layout.alert')
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    @foreach ($cartoes as $card)
                                        <article class="card col-md-3 py-3">
                                            <div class="row">
                                                <div class="col-md-2 offset-md-1">

                                                    @if ($card->flag_card == 'Visa')
                                                        <img src="{{ asset('img/card-visa.png') }}">
                                                    @elseif ($card->flag_card == 'Master')
                                                        <img src="{{ asset('img/card-master.png') }}">
                                                    @elseif($card->flag_card == 'Elo')
                                                        <img src="{{ asset('img/card-elo.png') }}">
                                                    @elseif($card->flag_card == 'America-Express')
                                                        <img src="{{ asset('img/card-americanexpress.png') }}">
                                                    @else
                                                        <img src="{{ asset('img/card-hipercard.png') }}">
                                                    @endif


                                                </div>
                                                <div class="col-md-6 offset-md-1">
                                                    <h1>**** **** **** {!! substr($card->number_card, -4) !!}</h1>
                                                    <h4> Expira em <b>{{ $card->card_expiry_date }}</b> </h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn-delete" href="{!! route('delet-card', $card->card_id) !!}"><img
                                                            src="{{ asset('img/delete-card.png') }}"></a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                            @if ($cartoes)
                                <div class="col-md-12 text-center empty">
                                    <img src="{!! asset('img/cards-empty.png') !!}">
                                    <h1>Você ainda não possui cartão para pagamentos,
                                        <BR>clique no link abaixo para adicionar</h1>
                                    <a href="{{ route('customerarea-my-card') }}">+ Adicionar Novo</a>
                                </div>
                            @endif
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
@endsection