@extends('layouts.app')
@section("content")

    @foreach($retour as $serie)
        ID Série : {{$serie->id}}<br>
        Nom Série : {{$serie->nom}}<br>
    <br><br>
    @endforeach





@endsection
