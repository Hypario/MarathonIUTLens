@extends('layouts.app')
@section('title',$series->nom)

@section('content')
    <div class="contentSerie">
        <div>
            <p class="titre">{{ $series->nom }}</p>
        </div>
        <div class="infoSerie">
            <div>

                <p><strong>Langue : </strong>{{$series->langue}}</p>
            </div>
            <div>

                <p><strong>Note : </strong>{{$series->note}}</p>
            </div>
            <div>

                <p><strong>Statut : </strong>{{$series->statut}}</p>
            </div>

            <div>
                <p><strong>Première : </strong>{{$series->premiere}}</p>
            </div>
        </div>

        <p><img src={{ url($series->urlImage) }} class="vignetteSerie"/></p>
        @if($user["authentificated"])
            <div>
                <p>
                    <b>Appréciation de la série : </b>
                    @if($isSerieLiked)
                        Vous aimez déjà la série
                    @else
                        <button>Aimer la série</button>
                    @endif
                </p>
            </div>
        @endif



        @if($series->avis = null)
            <div>
                <p><strong>Avis de la rédaction: </strong>{{$series->avis}}</p>
            </div>
        @else
            <div>
                <p><strong>Avis de la rédaction : </strong> Pas encore d'avis de la rédaction disponible :(</p>
            </div>
        @endif
        @if($series->urlAvis != null)
            <div>
                <p><strong>Vidéo critique : </strong></p>

                <p>
                    <video controls width="250">

                        <source src={{$series->urlAvis}}
                            type="video/mp4">
                        Désolé, votre navigateur ne supporte pas les vidéos :(.
                    </video>
                </p>
            </div>
        @else
            <div>
                <p><strong>Vidéo critique : </strong>Pas de vidéo critique de la rédaction disponible :(</p>
            </div>
        @endif

        <div id="episodes">
            @foreach($saisons as $saison => $episodes )
                <p>Saison n°{{ $saison }}</p>
                @foreach($episodes as $episode)
                    <div>
                        <a href="{{ route('episode.show', [$series->id, $episode->numero]) }}">
                            @if ($episode->urlImage)
                                <img src="{{ url($episode->urlImage) }}"/>
                            @endif
                        Episode n°{{ $episode->numero }} {{ $episode->nom }}
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>

        <h1>Les commentaires :</h1>

        @if (\Illuminate\Support\Facades\Auth::check())
            <form action="{{ route('comment.post', $series->id) }}" method="post">
                {{ csrf_field() }}
                <textarea name="content" id="content" cols="30" rows="10"
                          placeholder="Cette série est génial, j'aime trop..."></textarea>

                <select name="note" id="note">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <button type="submit">Envoyer</button>
            </form>
        @endif

        @if (!$comments->isEmpty())
            @foreach($comments as $comment)
                @if ($comment->validated === 1)
                    <h2>{{ $comment->utilisateur->name }}</h2>
                    <h2>{{ $comment->note }} / 10</h2>
                    <p>{{ $comment->content }}</p>
                @elseif (Auth::check() && Auth::user()->administrateur === 1)
                    <h2>{{ $comment->utilisateur->name }}</h2>
                    <h2>{{ $comment->note }} / 10</h2>

                    <form action="{{ route('comment.valid', $comment->id) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit">Valider</button>
                    </form>

                    <form action="{{ route('comment.reject', $comment->id) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit">refuser</button>
                    </form>

                    <p>{{ $comment->content }}</p>
                @endif
            @endforeach
        @else
            <h1>Aucun commentaire pour cette série</h1>
        @endif
    </div>


@endsection
