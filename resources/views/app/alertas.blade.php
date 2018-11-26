@extends('layouts.app')

@section('content')
	@component('../components/section-card')
	<div id="app">
		<div class="container" style="padding: 1rem;">
		@php
			$user = Auth::user();
			$news = App\Document::where('owner_id', $user->id)
						->orderBy('updated_at', 'desc')
						->with('requeriment', 'incidences')
						->take(20)
						->get();
			/*$incidences = App\Incidence::where('user_id', $user->id)
						->orderBy('updated_at', 'desc')
						->with('incidenceType')
						->take(15)
						->get();
			$incidences->load(['document' => function($q) {
                         	$q->with('requeriment');
                   	}]);*/
			$quantNews = count($news);
			//$quantInci = count($incidences);
		@endphp
			<div class="panel panel-info">
			<div class="row">
				<div class="col-md-12">
				<div class="panel-heading">
					<h4>Notificaciones sobre sus documentos</h4>
				</div>
				<div class="panel-body">
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th scope="col">Requerimiento</th>
							<th scope="col">Archivo</th>
							<th scope="col">Status</th>
							<th scope="col">Incidencia</th>
							<th scope="col">Fecha</th>
						</tr>
					</thead>
					<tbody>
						@if ($quantNews > 0)
							@foreach ( $news as $new )
								@if ($new->status == 'PENDIENTE')
									<tr>
										<td>{{$new->requeriment->name}}</td>
										<td><a href="/{{$new->file_path}}" target="_blank">{{$new->name}}</a></td>
										<td>{{ucwords($new->status)}}</td>
										@if (count($new->incidences) >= 1)
											<td>{{$new->incidences[0]->description}}</td>
										@else
											<td></td>
										@endif
										<td>{{$new->updated_at}}</td>
									</tr>		
								@elseif($new->status == 'ACEPTADO')
									<tr class="alert alert-success">
										<td>{{$new->requeriment->name}}</td>
										<td><a href="/{{$new->file_path}}" target="_blank">{{$new->name}}</a></td>
										<td>{{ucwords($new->status)}}</td>
										@if (count($new->incidences) >= 1)
											<td>{{$new->incidences[0]->description}}</td>
										@else
											<td></td>
										@endif
										<td>{{$new->updated_at}}</td>
									</tr>			
								@else
									<tr class="alert alert-warning" style="background-color: #f8d7da">
										<td>{{$new->requeriment->name}}</td>
										<td><a href="/{{$new->file_path}}" target="_blank">{{$new->name}}</a></td>
										<td>{{ucwords($new->status)}}</td>
										@if (count($new->incidences) >= 1)
											<td>{{$new->incidences[0]->description}}</td>
										@else
											<td></td>
										@endif
										<td>{{$new->updated_at}}</td>
									</tr>		
								@endif
							@endforeach
						@else
							No posee notificaciones. Por favor inicie con la carga de documentos.
						@endif
					</tbody>
				</table>
				</div>
				</div>
				{{--<div class="col-md-6">
				<div class="panel-heading">
					<h4>Incidencias</h4>
				</div>
				<div class="panel-body">
					<ul>
						@if ($quantInci > 0)							
							@foreach ( $incidences as $incidence )
								<div class="alert alert-info">
									<li class="list-group-item">
										Su documento para el requerimiento <strong>{{$incidence->document->requeriment->name}}</strong> ha recibido una incidencia de tipo <strong>{{$incidence->incidenceType->type}}</strong> con el siguiente mensaje: <em><strong>{{$incidence->description}}</strong></em></li>
								</div>				
								
							@endforeach
						@else
							Aun no se le ha registrado ninguna incidencia
						@endif
					</ul>
				</div>
				</div>--}}
			</div>
			</div>
		</div>
	</div>
	</div>
	@endcomponent
@endsection