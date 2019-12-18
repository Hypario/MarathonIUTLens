@extends('layouts.app')

@section('content')

    Acceuil
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
                    <br>{{$serie->urlimage}}
                    <br>{{$serie->avis}}
                    <br>{{$serie->urlAvis}}</li>
            @endforeach
        </ul>
    @else
        <h3>aucune serie</h3>
    @endif

@endsection
