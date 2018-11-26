@extends('layouts.app')

@section('content')
	@component('../components/section-card')
	<div id="app">
        <div class="container">
            <div class="card-body pm-2">
                <form method="POST"  action="{{ route('home-preguntas') }}" >
                    @csrf
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="question" name="question" placeholder="Escribe tu pregunta aquì" required></textarea>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                    </div>
                </form>
                <div class="list-group">
                    @foreach( $questions as $question )
                    <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"></h5>
                        <small>{{ $question->created_at->format('d/m/Y h:m A') }}</small>
                        </div>
                        <p class="mb-1"><strong>Pregunta :</strong> {{$question->question}}</p>
                        @if( $question->status == 'pendiente' )
                            <small class="badge badge-info pm-3">{{ $question->status}} </small>
                        @else
                            <p class="mb-1"><strong> Respuesta :</strong> {{$question->reply->reply}}</p>
                            <small class="badge badge-info pm-3">{{ $question->status}} </small>
                        @endif 
                    </div>     
                    @endforeach
                    <div class="mt-2 pm-2">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
	</div>
	@endcomponent
@endsection