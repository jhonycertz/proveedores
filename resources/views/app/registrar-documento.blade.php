@extends('layouts.app')

@section('content')
	@component('../components/section-card')
    @php
        $user = Auth::user();
        $uploadedDocuments = App\Document::where('owner_id', $user->id)->get();
        $requeriments = json_encode($requeriments);
        $requeriments = json_decode($requeriments);
        foreach ($requeriments as $key => $requeriment) {
            foreach($uploadedDocuments as $k => $document){
                if($document->requeriment_id == $requeriment->id && $document->status != 'RECHAZADO'){
                   unset($requeriments[$key]);
                }
            }
        }
        /*foreach($company->companyType->requeriments as $i => $rq){
            foreach($uploadedDocuments as $j => $doc){
                if($doc->requeriment_id == $rq->id && $doc->status == 'PENDIENTE'){
                    $rq->status = 1;
                }elseif($doc->requeriment_id == $rq->id && $doc->status == 'ACEPTADO'){
                    $rq->status = 2;
                    dd(json_encode($company->companyType->requeriments));
                }elseif($doc->requeriment_id == $rq->id && $doc->status == 'RECHAZADO'){
                    $rq->status = 3;
                }else{
                    $rq->status = 4;
                }
            }
        }*/
    @endphp
	<div id="app">
        <div class="container">
            <div class="card-body row">
                <div class="col-md-7">
                <form method="POST"  action="{{ route('home-registrar-documento') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <div class="col">
                            <label class="col-form-label" for="requeriment_id">Requerimientos faltantes</label>
                            <select id="requeriment_id" class="custom-select" name="requeriment_id">
                                @foreach ($requeriments as $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="col-form-label" for="requeriment_id"> Documento PDF </label>
		    	            <input type="file"  class="custom-select" name="file" accept="application/pdf" required>
                        </div>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                    </div>
                </form>

                @if (count($errors) > 0)
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
                <div class="col-md-5">
                <div class="pt-2">
                    <p> <strong> Estas optando por el puesto </strong> {{ $company->companyType->type}} </p>
                    <p> Los Requisitos son los siguientes </p>
                    <div class="list-group">
                        @foreach($company->companyType->requeriments as $requeriment)
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1">
                                {{$requeriment->code}} - {{$requeriment->name}}
                            </p>
                            <small class="text-muted"{{$requeriment->require}}> 
                               {{-- @if($requeriment->status == 1)
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;Pendiente de aprobación
                                @elseif($requeriment->status == 2)
                                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Aceptado
                                @elseif($requeriment->status == 3)
                                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Rechazado
                                @else
                                    <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Sin cargar
                                @endif--}}
                            </small>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
	</div>
	@endcomponent
@endsection
