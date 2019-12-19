@extends('layouts.app')
@section('title','Accueil')
@section('content')

    <h2 class="categorie">{{ $genre->nom }}</h2>
    <hr>

    <ul>
        @foreach($mostViewed as $serie)
            <li>
                <div class="serie">
                    <img src="{{ url($serie->urlImage) }}" class="affiche">
                    <a class="serie-hover" href="{{ route('serie.show', $serie->id) }}">
                        <h2 class="title">{{ $serie->nom }} <br> {{ date('Y', strtotime($serie->premiere)) }} <br> {{ isset($serie->note) ? $serie->note : '- ' }}/10 </h2>
                    </a>

                </div>
            </li>
        @endforeach
    </ul>

@endsection
