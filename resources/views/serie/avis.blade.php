@extends('layouts.app')
@section('title',"Avis Administrateur")

@section('content')
<form action="{{ route('admin.sndavis', $serie->id) }}" method="post">
    @if(!is_null($serie->avis) && !empty($serie->avis))
        <h3>L'avis actuel est :</h3> <br><textarea disabled value="" rows="5" cols="33" style="width:50%; height: 50%">{{ $serie->avis }}</textarea><br><br>
    @endif
        {{ csrf_field() }}
        <textarea rows="5" cols="33" style="width:50%; height: 50%" name="avis" placeholder="Entrez ici l'avis de la rédaction" ></textarea><br>

    <input type="submit" value="Appliquer les Modifications">
</form>

@endsection
