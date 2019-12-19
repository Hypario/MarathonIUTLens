@extends('layouts.app')
@section('title',$serie->nom,'Episode n°',$episode->numero)

@section('content')
    <di>
        <a href="{{ route('serie.show',[$serie->id]) }}">retour à la série.</a>
    </di>
    <div>
        <p>{{$serie->nom}}, saison {{$episode->saison}}</p>
        <p>Episode n°{{$episode->numero}}; {{$episode->nom}}.</p>
    </div>
    <div>
        <p>
            @if ($episode->urlImage)
                <img src={{ url($episode->urlImage) }} />
            @endif
        </p>
    </div>
    @if($user["authentificated"])
        <div>
            <p>
                <b>Appréciation de la série : </b>
                @if($isEpisodeSeen)
                    Vous avez déjà vu l'épisode
                @else
                    <a href="{{ route('episode.see',$episode->id) }}">Voir l'épisode</a>
                @endif
            </p>
        </div>
    @endif
    <div>

        <p><strong>Résumé : </strong>{!! html_entity_decode($episode->resume)!!}</p>
    </div>
    <div>

        <p><strong>Durée : </strong>{{$episode->duree}} minutes.</p>
    </div>

    <div>
        <p><strong>Première : </strong>{{$episode->premiere}}</p>
    </div>



    @if ($previous)
        <a href="{{ route('episode.show', [$serie->id, $previous]) }}">Épisode précédent</a>
    @endif

    @if ($next)
        <a href="{{ route('episode.show', [$serie->id, $next]) }}">Épisode suivant</a>
    @endif

@endsection
