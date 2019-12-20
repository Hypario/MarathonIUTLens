@extends('layouts.app')
@section('title',$series->nom)

@section('content')
    <div class="categories">
        <div>
            <div>
                <h2 class="titre">{{ $series->nom }}</h2>
                <hr class="hr-horizontal">
            </div>

            <div class="info-serie">
                <img src="{{ url($series->urlImage) }}" class="affiche"/>
                <div class="info-serie-ecrit">
                    <p><strong>Genre: </strong>{{$series->genre}}</p>
                    <p><strong>Langue : </strong>{{$series->langue}}</p>
                    <p><strong>Note : </strong>{{$series->note}}</p>
                    <p><strong>Moyenne  : </strong> {{ $moyenne ? $moyenne : "Pas de moyenne" }}</p>
                    <p><strong>Statut : </strong>{{$series->statut}}</p>
                    <p><strong>Première : </strong>{{$series->premiere}}</p>

                </div>
                <hr class="hr-vertical">
                <div class="resume"><strong>Résumé : </strong>{!! $series->resume !!}</div>
            </div>

            @if(Auth::check())
                <div>
                    <p>
                        <b>Etat de la série : </b>
                        @if($isSerieSeen)
                            Vous avez déjà vu la série
                        @else
                            <a href="{{ route('serie.see',$series->id) }}">Voir la série</a>
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <div>
            @if($series->avis = null)
                <div>
                    <h2 class="titre">L'avis de la rédaction</h2>
                    <hr class="hr-horizontal">
                </div>
            @else
                <div>
                    <h2 class="titre">L'avis de la rédaction</h2>
                    <hr class="hr-horizontal">
                    <p>Pas encore d'avis de la rédaction disponible :(</p>
                </div>
            @endif


            @if($series->urlAvis != null)
                <div class="avisVideoSerie">
                    <p><strong>Vidéo critique : </strong></p>
                    <p>
                        <video controls width="250">

                            <source src={{url($series->urlAvis)}}
                                type="video/mp4">
                            Désolé, votre navigateur ne supporte pas les vidéos :(.
                        </video>
                    </p>
                </div>
            @else
                <div class="avisVideoSerie">
                    <p><strong>Vidéo critique : </strong>Pas de vidéo critique de la rédaction disponible :(</p>
                </div>
            @endif

            @if(Auth::check() && Auth::user()->administrateur === 1)
                <a href="{{ route("admin.avis",$series->id) }}">Changer l'avis administrateur</a>
            @endif
        </div>

        <h2 class="titre">Commentaires</h2>
        <hr class="hr-horizontal">

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
                    <div class="commentaire">
                        <h2>{{ $comment->utilisateur->name }} {{ $comment->note }} / 10</h2>
                        <p>{{ $comment->content }}</p>
                    </div>

                @elseif (Auth::check() && Auth::user()->administrateur === 1)
                    <div>
                        <h2>{{ $comment->utilisateur->name }} {{ $comment->note }} / 10</h2>

                        <form action="{{ route('comment.valid', $comment->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit">Valider</button>
                        </form>

                        <form action="{{ route('comment.reject', $comment->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit">refuser</button>
                        </form>

                        <p>{{ $comment->content }}</p>
                    </div>

                @endif
            @endforeach
        @else
            <h1>Aucun commentaire pour cette série</h1>
        @endif


        <div>
            @foreach($saisons as $saison => $episodes)
                <h2 class="titre">Saison n°{{ $saison }}</h2>
                <hr class="hr-horizontal">
                <div class="episodes">
                    @foreach($episodes as $episode)
                    <div>
                        <a href="{{ route('episode.show', [$series->id, $episode->numero]) }}">
                            @if ($episode->urlImage)
                                <img src="{{ url($episode->urlImage) }}"/ class="miniature">
                            @endif
                            Episode n°{{ $episode->numero }} {{ $episode->nom }}
                        </a>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>


    </div>


@endsection
