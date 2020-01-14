@extends('layouts.app')
@section('title','Accueil')
@section('content')

    <h2 class="titre">Titre contenant {{ $saisie }}</h2>
    <hr class="hr-horizontal">

    <ul>
        @if (!is_null($series))
            @foreach($series as $serie)
                <li>
                    <div class="serie">
                        <img src="{{ url($serie->image) }}" class="affiche">
                        <a class="serie-hover" href="{{ route('serie.show', $serie->id) }}">
                            <h2 class="title">{{ $serie->nom }} <br> {{ date('Y', strtotime($serie->premiere)) }}
                                <br> {{ isset($serie->note) ? $serie->note : '- ' }}/10 </h2>
                        </a>
                    </div>
                </li>
            @endforeach
        @else
            <p>Aucune série</p>
        @endif
    </ul>

@endsection
