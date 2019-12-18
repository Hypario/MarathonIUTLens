@extends('layouts.app')
@section('title',$serie->nom," saison ",$saison)

@section('content')
    <div>

        <p><strong>Nom : </strong>{{$serie->nom}}</p>
    </div>
    <div>
        <p><strong>Saison n°</strong>{{$num_saison}}</p>
    </div>
    @foreach($saison as $episode)

        <div>
            <p><strong>Episode n°</strong>{{$episode->numero}}</p>
            <p>Nom : {{$episode->nom}}</p>
            <a href="/serie/{{$serie->id}}/{{$episode->numero}}" ><img src={{ url($episode->urlImage) }} /></a>

        </div>
    @endforeach

@endsection
