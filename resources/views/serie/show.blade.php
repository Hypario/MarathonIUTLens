@extends('layouts.app')
@section('title',$series->nom)

@section('content')
    <div>

        <p><strong>Nom : </strong>{{$series->nom}}</p>
    </div>
    <div>

        <p><strong>Resume : </strong>{{$series->resume}}</p>
    </div>
    <div>

        <p><strong>Langue : </strong>{{$series->langue}}</p>
    </div><div>

        <p><strong>Note : </strong>{{$series->note}}</p>
    </div>
    <div>

        <p><strong>Statut : </strong>{{$series->statut}}</p>
    </div>

    <div>
        <p><strong>Première : </strong>{{$series->premiere}}</p>
    </div>

    <div>
        <p>Image : <img src={{ $series->urlImage }} /></p>
    </div>

    <div>
        <p><strong>Avis : </strong>{{$series->avis}}</p>
    </div>

    <div>

        <p><strong>UrlAvis : </strong>{{$series->urlAvis}}</p>
    </div>


@endsection