@extends('layouts.app')
@section('title',$serie->nom,'Episode n°',$episode->numero)

@section('content')
    <div>
        <p>{{$serie->nom}}, saison {{$episode->saison}}, épisode n°{{$episode->numero}}; {{$episode->nom}}.</p>
    </div>
    <div>

        <p><strong>Resume : </strong>{!! html_entity_decode($episode->resume)!!}</p>
    </div>
    <div>

        <p><strong>Durée : </strong>{{$episode->duree}} minutes.</p>
    </div>

    <div>
        <p><strong>Première : </strong>{{$episode->premiere}}</p>
    </div>

    <div>
        <p><img src={{ $episode->urlImage }} /></p>
    </div>

    @if ($previous)
        <a href="{{ route('episode.show', [$serie->id, $previous]) }}">Épisode précédent</a>
    @endif

    @if ($next)
        <a href="{{ route('episode.show', [$serie->id, $next]) }}">Épisode suivant</a>
    @endif

@endsection
