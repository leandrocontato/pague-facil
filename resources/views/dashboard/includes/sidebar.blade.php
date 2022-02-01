<div class="sidebar">        
    <a href="{!!route('dashboard-home')!!}" class="logo text-center">
        <img src="{!!secure_asset('img/pague-facil-login.png')!!}" alt="Pague Fácil" height="40" class="logo-full">
        <img src="{!!secure_asset('img/pague-facil-min.png')!!}" alt="Pague Fácil" height="40" class="logo-min">
    </a>
    <div class="h-100" data-simplebar="init">
       <div class="content-menu">
       		<ul class="nav flex-column">
       			<li class="nav-item">
			    	<a class="nav-link" href="{!!route('dashboard-home')!!}">
			    		<i title="Inicio" class="fa fa-home"></i> 
			    		<span class="title">Inicio</span> 
			    	</a>
			  	</li>
       			<li class="nav-item">
			    	<a class="nav-link" href="{!!route('dashboard-customer')!!}">
			    		<i title="Clientes" class="fa fa-users"></i> 
			    		<span class="title">Clientes</span> 
			    	</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link side-nav-link" href="#menu-financeiro" data-bs-toggle="collapse" aria-expanded="false" aria-controls="menu-financeiro">
			    		<i title="Financeiro" class="fa fa-wallet"></i> 
			    		<span class="title">Financeiro</span> 
			    		<span class="menu-arrow"></span>
			    	</a>
			    	<div class="collapse" id="menu-financeiro">
			    		<ul>
			    			{{-- <li>
			    				<a href="">Contas a Receber</a>
			    			</li> --}}
			    		</ul>
			    	</div>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link side-nav-link" href="#menu-configuracoes" data-bs-toggle="collapse" aria-expanded="false" aria-controls="menu-configuracoes">
			    		<i title="Configurações" class="fa fa-cogs"></i> 
			    		<span class="title">Configurações</span> 
			    		<span class="menu-arrow"></span>
			    	</a>
			    	<div class="collapse" id="menu-configuracoes">
			    		<ul>
			    			<li>
			    				<a href="{!!route('dashboard-user')!!}">Usuários</a>
			    			</li>
			    			<li>
			    				<a href="{!!route('dashboard-countrie')!!}">Paises</a>
			    			</li>
			    			{{-- <li>
			    				<a href="{!!route('dashboard-state')!!}">Estados</a>
			    			</li> --}}
			    			{{--<li>
			    				<a href="">Grupos de Usuários</a>
			    			</li>
			    			<li>
			    				<a href="">Cidades</a>
			    			</li>
			    			<li>
			    				<a href="">Categorias de Pagamento</a>
			    			</li>--}}
			    		</ul>
			    	</div>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="{!!route('dashboard-logout')!!}">
			    		<i title="Sair" class="fa fa-sign-out-alt"></i> 
			    		<span class="title">Sair</span>
			    	</a>
			  	</li>
			</ul>
       </div>
    </div>
</div>