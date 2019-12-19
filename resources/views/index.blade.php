@extends('layouts.app')
@section('title','Accueil')
@section('content')

    <div>
        <h2 class="titre">Les plus vues</h2>
        <hr class="hr-horizontal">
        <ul>
            @foreach($mostViewed as $serie)
                <li>
                    <div class="serie">
                        <img src="{{ url($serie->urlImage) }}" class="affiche">
                        <a class="serie-hover" href="{{ route('serie.show', $serie->id) }}">
                            <h2 class="title">{{ $serie->nom }} <br> 
                                {{ date('Y', strtotime($serie->premiere)) }} <br> 
                                {{ isset($serie->note) ? $serie->note : '- ' }}/10 
                            </h2>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div>
        <h2 class="titre">Les plus commentées</h2>
        <hr class="hr-horizontal">
        <ul>
            @foreach($mostReviewed as $serie)
                <li>
                    <div class="serie">
                        <img src="{{ url($serie->urlImage) }}" class="affiche">
                        <a class="serie-hover" href="{{ route('serie.show', $serie->id) }}">
                            <h2 class="title">{{ $serie->nom }} <br> 
                                {{ date('Y', strtotime($serie->premiere)) }} <br> 
                                {{ isset($serie->note) ? $serie->note : '- ' }}/10 
                            </h2>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    
@endsection
