@extends('welcome.app')


@section('content')

<div class="section bg-gradient" >  
	<div class="container">
		<div>
			<div class="card">
			  <div class="card-body">
				<h4> Registro Completado</h4>
				<p><strong>Nombre :</strong> {{ $company->name}}</p>
				<p><strong>Rif :</strong> {{ $company->identity}}</p>
				<p><strong>Correo</strong> {{ $company->email}}</p>
				<p><strong>Telefono :</strong> {{ $company->phone}}</p>
				<p><strong>Dirección :</strong> {{ $company->address}}</p>
				<p><strong>Clasificación :</strong> {{ $company->companyType->type}}</p>
				<p>Estaremos comunicando el estado de su solicitud!</p>
			  </div>
			</div>
		</div>		



@endsection