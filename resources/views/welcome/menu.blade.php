@component('../components/nav-menu')
	<nav class="navbar navbar-dark navbar-expand-lg">
		<a class="navbar-brand" href="{{ route('root') }}">
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
				<li class="nav-item"> <a class="nav-link active" href="#home">HOME <span class="sr-only">(current)</span></a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('root') }}#features">FEATURES</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('root') }}#gallery">GALLERY</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('root') }}#pricing">PRICING</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('root') }}#contact">CONTACT</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('register.company') }}">REGISTRAR</a> </li>
				<li class="nav-item"> <a class="nav-link" href="{{ route('login') }}">INGRESAR</a> </li>
			</ul>
		</div>
	</nav>
@endcomponent