@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/customerarea.css') }}">
@endsection

@section('title')
    Meus Dados - Pague Fácil
@endsection

@section('content')
    <div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <div class="auth-brand text-center mb-4">
                        <a href="{!! route('customerarea-auth') !!}">
                            <span>
                                <img src="{!! secure_asset('img/pague-facil.png') !!}" alt="Pague Fácil">
                            </span>
                        </a>
                    </div>
                    <p class="text-muted mb-4">
                        Ainda não tem cadastro com a gente? <br>Não deixe de aproveitar esta oportunidade e faça já sua
                        inscrição.
                    </p>
                </div>
                <div class="col-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <form action="{!! route('create-user') !!}" method="POST">
                                    {{-- @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach --}}
                                    @csrf
                                    <div class="my-2 col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="">Tipode cadastro</label>
                                        <select name="type" id="">
                                            <option value="1">Físico</option>
                                            <option value="2">Jurídico</option>
                                        </select>
                                        @if (!empty($errors->first('type')))
                                            <label class="invalid-feedback">{!! $errors->first('type') !!}</label>
                                        @endif
                                    </div>
                                    <div class="row d-none type-physical">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="first_name">Nome</label><input type="text" name="first_name">
                                            @if (!empty($errors->first('first_name')))
                                                <label class="invalid-feedback">{!! $errors->first('first_name') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="last_name">Sobrenome</label><input type="text" name="last_name">
                                            @if (!empty($errors->first('last_name')))
                                                <label class="invalid-feedback">{!! $errors->first('last_name') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="cpf">CPF</label><input type="text" name="cpf">
                                            @if (!empty($errors->first('cpf')))
                                                <label class="invalid-feedback">{!! $errors->first('cpf') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row d-none type-jury">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="company_name">Razão social</label><input type="text"
                                                name="company_name">
                                            @if (!empty($errors->first('company_name')))
                                                <label class="invalid-feedback">{!! $errors->first('company_name') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="fantasy_name">Nome fantasia</label><input type="text"
                                                name="fantasy_name">
                                            @if (!empty($errors->first('fantasy_name')))
                                                <label class="invalid-feedback">{!! $errors->first('fantasy_name') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="cnpj">CNPJ</label><input type="text" name="cnpj">
                                            @if (!empty($errors->first('cnpj')))
                                                <label class="invalid-feedback">{!! $errors->first('cnpj') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="address">Endereço</label><input type="text" name="address">
                                            @if (!empty($errors->first('address')))
                                                <label class="invalid-feedback">{!! $errors->first('address') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="number">Número</label><input type="text" name="number">
                                            @if (!empty($errors->first('number')))
                                                <label class="invalid-feedback">{!! $errors->first('number') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="complement">Complemento</label><input type="text" name="complement">
                                            @if (!empty($errors->first('complement')))
                                                <label class="invalid-feedback">{!! $errors->first('complement') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="neighoarhood">Bairro</label><input type="text" name="neighoarhood">
                                            @if (!empty($errors->first('neighoarhood')))
                                                <label class="invalid-feedback">{!! $errors->first('neighoarhood') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="cep"></label>CEP<input type="text" name="cep">
                                            @if (!empty($errors->first('cep')))
                                                <label class="invalid-feedback">{!! $errors->first('cep') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="countrie_id">País</label>
                                            <select name="countrie_id" id="">
                                                <option value="55">Brasil</option>
                                                <option value="Argentina">Argentine</option>
                                            </select>
                                            @if (!empty($errors->first('countrie_id')))
                                                <label class="invalid-feedback">{!! $errors->first('countrie_id') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="state_id">Estado</label>
                                            <select name="state_id" id="">
                                                <option value="Mato Grosso">Mato Grosso</option>
                                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                            </select>
                                            @if (!empty($errors->first('state_id')))
                                                <label class="invalid-feedback">{!! $errors->first('state_id') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="citie_id">Cidade</label>
                                            <select name="citie_id" id="">
                                                <option value="Cuiaba">Cuiabá</option>
                                                <option value="Varzea Grande">Varzea Grande</option>
                                            </select>
                                            @if (!empty($errors->first('citie_id')))
                                                <label class="invalid-feedback">{!! $errors->first('citie_id') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="phone">Telefone</label><input type="text" name="phone">
                                            @if (!empty($errors->first('phone')))
                                                <label class="invalid-feedback">{!! $errors->first('phone') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="cellphone">Celular</label><input type="text" name="cellphone">
                                            @if (!empty($errors->first('cellphone')))
                                                <label class="invalid-feedback">{!! $errors->first('cellphone') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="accredited">É credenciado?</label>
                                            <select name="accredited" id="">
                                                <option value="1">Sim</option>
                                                <option value="2">Não</option>
                                            </select>
                                            @if (!empty($errors->first('accredited')))
                                                <label class="invalid-feedback">{!! $errors->first('accredited') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="email">E-mail</label><input type="text" name="email">
                                            @if (!empty($errors->first('email')))
                                                <label class="invalid-feedback">{!! $errors->first('email') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="password">Senha</label><input type="text" name="password">
                                            @if (!empty($errors->first('password')))
                                                <label class="invalid-feedback">{!! $errors->first('password') !!}</label>
                                            @endif
                                        </div>
                                        <div class="my-2 col-12 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <label for="status">Situação</label>
                                            <select name="status" id="">
                                                <option value="1">Válido</option>
                                                <option value="">Pendente</option>
                                            </select>
                                            @if (!empty($errors->first('status')))
                                                <label class="invalid-feedback">{!! $errors->first('status') !!}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button>Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth-fluid-right text-center"></div>

        </div>

    @endsection
    @section('script')
        <script src="{{ secure_asset('js/customerarea.js') }}"></script>
        <script src="{{ secure_asset('js/dashboard.js') }}"></script>
    @endsection
