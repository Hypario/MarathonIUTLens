@extends('layouts.app')

@section('content')

    <h2 class="categorie">La liste des series</h2>
    <hr>

    @if(!empty($series))
        <ul>
            @foreach($series as $serie)
            <li>
                <div class="serie">
                    <a class="serie-hover" href="{{ route('serie.show', $serie->id) }}">
                        <h2 class="title">{{ $serie->nom }} <br> {{ date('Y', strtotime($serie->premiere)) }} <br> {{ isset($serie->note) ? $serie->note : '- ' }}/10 </h2>
                        
                        <span class="resume">
                            {!! html_entity_decode($serie->resume)!!}
                        </span>
                    </a>
                    <img src="{{ $serie->urlImage }}" class="affiche">
                </div>
                
            </li>
            @endforeach
        </ul>
    @else
        <h3>Aucune série n'est présente</h3>
    @endif

@endsection
