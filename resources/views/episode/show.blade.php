@extends('layouts.app')
@section('title',$serie->nom,'Episode n°',$episode->numero)

@section('content')
    <div id="retourSerie">
        <a href="{{ route('serie.show', [$serie->id]) }}" style="color: #115557;">retour à la série</a>
    </div>
    <div>
        <p ><strong class="titre">{{$serie->nom}}</strong></p>
        <p class="titre"> saison {{$episode->saison}} Episode n°{{$episode->numero}}, {{$episode->nom}}.</p>
    </div>
    <div>
        <p>
            @if ($episode->urlImage)
                <img src={{ url($episode->urlImage) }} id="imageEpisode"/>
            @else
                <div id="imageEpisode" class="textImage">Pas de preview disponible.</div>
            @endif
        </p>
    </div>

    <div id="infoEpisode">

        <div>
            @if($episode->resume)
                <p><strong>Résumé : </strong>{!! html_entity_decode($episode->resume)!!}</p>
            @else
                <p><strong>Résumé : </strong>Pas de résumé disponible.</p>
            @endif

        </div>
        <div>
            <p><strong>Durée : </strong>{{$episode->duree}} minutes.</p>
        </div>
        <div>
            <p><strong>Première : </strong>{{$episode->premiere}}</p>
        </div>
        @if(Auth::check())
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
    </div>



    @if ($previous)
        <a href="{{ route('episode.show', [$serie->id, $previous]) }}" id="previousEp">Épisode précédent</a>
    @endif

    @if ($next)
        <a href="{{ route('episode.show', [$serie->id, $next]) }}" id="nextEP">Épisode suivant</a>
    @endif

@endsection
