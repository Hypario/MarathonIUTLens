@extends('layouts.app')
@section('title',$data["user"]->name)
@section('content')
Bienvenue {{$data["user"]->name}} !<br>

    Vous avez posté {{$data["stats"]["nbcomm"]}} commentaire(s) et avez passé {{$data["stats"]["duree"]}} heure(s) pour regarder des épisodes :smile:<br>
    Vous avez vu {{$data["stats"]["epvu"]}} épisode(s)<br>

    @if($data['user']->administrateur == 1)
        <b>Vous êtes administrateur ✊</b>

        <h2>Administration des Commentaires non-validés</h2>

        @foreach($data['comVerif'] as $comv)
            {{$comv->created_at}} > {{$comv->content}} / <a href="#">Valider</a> <a href="#">Supprimer</a><br>
        @endforeach










    @endif


    <h2>Les séries que vous avez vu :</h2>
    @foreach($data["seriesvues"] as $sv)
        <a href={{route('serie.show',$sv->serie_id)}}>{{$data["series"][$sv->serie_id-1]->nom}}</a><br>
    @endforeach

    <h2>Vos commentaires :</h2>
    @if(count($data["comments"]) >0)
    @foreach($data["comments"] as $comm)



    @endforeach

        @foreach($data["series"] as $serie)
            <h3>{{$serie->nom}}</h3>
            @foreach($data["comments"] as $comm)
                @if($comm->serie_id == $serie->id)
                    Commentaire posté le : {{$comm->created_at}}<br>
                    Note : {{$comm->note}}<br>
                    Validé :
                    @if($comm->validated == 1)
                        Oui
                    @else
                        Non
                    @endif
                    <br>
                    Contenu : {{$comm->content}}

                    <br><br>

                @endif

        @endforeach

        @endforeach




    @else
        Vous n'avez pas posté de commentaires
    @endif





@endsection
