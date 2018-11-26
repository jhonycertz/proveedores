@component('../components/nav-menu')
	<nav class="navbar navbar-dark navbar-expand-lg">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset('images/KraftHeinz.svg.png') }}" class="img-fluid" style="width: 11em;" alt="logo">
		</a>
		<button class="navbar-toggler" 
			type="button" 
			data-toggle="collapse" 
			data-target="#navbar" 
			aria-controls="navbar" 
			aria-expanded="false" 
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav ml-auto">
 				<li class="nav-item"> <a class="nav-link" href="{{ route('home-alertas') }}">NOTIFICACIONES E INCIDENCIAS</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('home-preguntas') }}">PREGUNTAS</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('home-registrar-documento') }}">REGISTRAR DOCUMENTO</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('home-documento') }}">DOCUMENTOS REGISTRADOS</a> </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                      data-toggle="dropdown" aria-haspopup="true">{{ Auth::guard('client')->user()->company->name }}<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           {{ __('cerrar sesiòn') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
			</ul>
		</div>
	</nav>
@endcomponent





