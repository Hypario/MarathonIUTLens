@extends('layouts.app')
@section('title',"Avis Administrateur")

@section('content')
<form action="{{ route('admin.sndavis', $serie->id) }}" method="post">
    @if(!is_null($serie->avis) && !empty($serie->avis))
        L'avis actuel est : <br><textarea disabled value="{{ $serie->avis }}" rows="5" cols="33" style="width:50%; height: 50%"></textarea><br>
    @endif
        {{ csrf_field() }}
        <textarea rows="5" cols="33" style="width:50%; height: 50%" name="avis" placeholder="Entrez ici l'avis de la rédaction" ></textarea><br>

    <input type="submit" value="Appliquer les Modifications">
</form>

@endsection
