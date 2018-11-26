@extends('layouts.app')

@section('content')
	@component('../components/section-card')
	<div id="app">
		<div class="container">
			
                <h4 style="margin-top: 12px;">Documentos registrados</h4>
			<div class="row pt-3">
				<div class="col-5">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach($documents as $document)
						<div style="margin: 1em !important">
							<a class="nav-link @if($document->status == 'PENDIENTE') 
										alert-info
									@elseif($document->status == 'RECHAZADO') 
										alert-danger
									@else
										alert-success
									@endif" 
								id="v-pills-home-tab" 
								data-toggle="pill" 
								href="/{{$document->file_path}}" 
								role="tab" 
								aria-controls="{{$document->requeriment->id}}-pills" 
								aria-selected="false">@if($document->status == 'PENDIENTE') 
										<small><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Pendiente</small>
									@elseif($document->status == 'RECHAZADO') 
										<small><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Rechazado</small>
									@else
										<small><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Aceptado</small>
									@endif 
									<br>
									{{$document->requeriment->name}}&nbsp; <a href="/{{$document->file_path}}"><i class="fa fa-file-pdf-o fa-2x"> </i></a></a>
								
						</div>	
						@endforeach
					</div>
				</div>
				<div class="col-7">
					<div class="tab-content p-0" id="v-pills-tabContent">
					@foreach($documents as $document)
						<div class="tab-pane fade @if ($loop->first) active show @endif" 
						id="{{$document->requeriment->id}}-pills" role="tabpanel" aria-labelledby="{{$document->requeriment->id}}-pills">
						<embed width="100%" height="500px" type="application/pdf" internalinstanceid="5" src="{{ asset(Storage::url($document->file_path)) }}">
						</div>
					@endforeach
					</div>
			  </div>
			</div>
		</div>
	</div>
	@endcomponent
@endsection

