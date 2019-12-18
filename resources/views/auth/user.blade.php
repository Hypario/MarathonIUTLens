@extends('layouts.app')

@section('content')
Bienvenue {{$data["user"]->name}} !<br>

    Vous avez posté {{$data["stats"]["nbcomm"]}} commentaire(s) et avez passé {{$data["stats"]["duree"]}} heure(s) pour regarder des épisodes :smile:<br>
    Vous avez vu {{$data["stats"]["epvu"]}} épisode(s)<br>



    <h2>Les séries que vous avez vu :</h2>
    @foreach($data["seriesvues"] as $sv)
        {{$data["series"][$sv->serie_id-1]->nom}}<br>
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
