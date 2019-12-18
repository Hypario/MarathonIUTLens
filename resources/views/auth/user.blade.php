@extends('layouts.app')

@section('content')
Bienvenue {{$data["user"]->name}} !<br>

    Vous avez posté {{$data["stats"]["nbcomm"]}} commentaire(s) et avez passé {{$data["stats"]["duree"]}} heure(s) pour regarder des épisodes :smile:<br>
    Vous avez vu {{$data["stats"]["epvu"]}} épisode(s)<br>

    <h3>Vos commentaires :</h3>
    @if(count($data["comments"]) >0)
    @foreach($data["comments"] as $comm)
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



    @endforeach
    @else
        Vous n'avez pas posté de commentaires
    @endif





@endsection
