@extends('layouts.app')
@section('title','Accueil')
@section('content')

    Accueil
    <br />
    <h2>La liste des series</h2>

    @if(!empty($series))
        <ul>

            @foreach($series as $serie)
                <li>{{$serie->nom}}
                    <br>{!! html_entity_decode($serie->resume)!!}
                    <br>{{$serie->langue}}
                    <br>{{$serie->note}}
                    <br>{{$serie->statut}}
                    <br>{{$serie->premiere}}
                    <br><a href={{route('serie.show',$serie->id)}}><img src={{ $serie->urlImage }} /></a></li>
            @endforeach
        </ul>
    @else
        <h3>Aucune série n'est présente</h3>
    @endif

@endsection
