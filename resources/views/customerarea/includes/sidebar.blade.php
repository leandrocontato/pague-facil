<div class="sidebar">
    <a href="{!! route('customerarea-home') !!}" class="logo text-center">
        <img src="{!! secure_asset('img/pague-facil-login.png') !!}" alt="Pague Fácil" height="40" class="logo-full">
        <img src="{!! secure_asset('img/pague-facil-min.png') !!}" alt="Pague Fácil" height="40" class="logo-min">
    </a>
    <div class="h-100" data-simplebar="init">
        <div class="content-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('customerarea-home') !!}">
                        <i title="Inicio" class="fa fa-home"></i>
                        <span class="title">Inicio</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i title="Financeiro" class="fa fa-wallet"></i>
                        <span class="title">Meus Pagamentos</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('my-cards') }}">
                        <i class="fas fa-credit-card"></i>
                        <span class="title">Meus cartões</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{!! route('customerarea-my-data') !!}">
                        <i title="Clientes" class="fa fa-user"></i>
                        <span class="title">Meus Dados</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('customerarea-logout') !!}">
                        <i title="Sair" class="fa fa-sign-out-alt"></i>
                        <span class="title">Sair</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
