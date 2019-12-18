@extends('layouts.app')
@section('title',$series->nom)

@section('content')
    <div>

        <p><strong>Nom : </strong>{{$series->nom}}</p>
    </div>
    <div>

        <p><strong>Resume : </strong>{!! html_entity_decode($series->resume)!!}</p>
    </div>
    <div>

        <p><strong>Langue : </strong>{{$series->langue}}</p>
    </div>
    <div>

        <p><strong>Note : </strong>{{$series->note}}</p>
    </div>
    <div>

        <p><strong>Statut : </strong>{{$series->statut}}</p>
    </div>

    <div>
        <p><strong>Première : </strong>{{$series->premiere}}</p>
    </div>

    <div>
        <p><img src={{ $series->urlImage }} /></p>
    </div>

    @if($series->avis = null)
        <div>
            <p><strong>Avis de la rédaction: </strong>{{$series->avis}}</p>
        </div>
    @else
        <div>
            <p><strong>Avis de la rédaction : </strong> Pas encore d'avis de la rédaction disponible :(</p>
        </div>
    @endif
    @if($series->urlAvis != null)
    <div>
        <p><strong>Vidéo critique : </strong></p>

        <p>
            <video controls width="250">

                <source src={{$series->urlAvis}}
                        type="video/mp4">
                Désolé, votre navigateur ne supporte pas les vidéos :(.
            </video>
        </p>
    </div>
    @else
        <div>
            <p><strong>Vidéo critique : </strong>Pas de vidéo critique de la rédaction disponible :(</p>
        </div>
    @endif

    <div id = "episodes">
        @foreach($saisons as $saison => $episodes )
            <p>Saison n°{{ $saison }}</p>
            @foreach($episodes as $episode)
                <div>
                    <img src={{ $episode->urlImage }} />
                    Episode n°{{$episode->numero}} {{$episode->nom}}
                </div>
            @endforeach
        @endforeach
    </div>

    @if (!$comments->isEmpty())
        <h1>Les commentaires :</h1>
        @foreach($comments as $comment)
            <h2>{{ $comment->utilisateur->name }}</h2>
            <p>{{ $comment->content }}</p>
        @endforeach
    @else
        <h1>Aucun commentaire pour cette série</h1>
    @endif

@endsection
