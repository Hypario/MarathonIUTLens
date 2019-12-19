<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SerieController extends Controller
{
    public function getAvisSerie($id, $user) {
        // on récupére tous les épisodes de la-dite série
        $eps = Episode::all()->where("serie_id","=",$id);

        // on récupére les infos sur l'utilisateur

        $vu = DB::table("seen")->select("episode_id")->where("user_id","=",$user->id)->get();

        $dt = [];

        foreach ($vu as $v) {
            array_push($dt,$v->episode_id);
        }



        foreach ($eps as $episode) {



            if (!in_array($episode->id,$dt)) {
                return false;
            }


    return true;
    }
    }

    public function show($id) {

        $user = [];
        if ($myuser = Auth::user()) {
            $user["authentificated"] = true;
            $user["userdata"] = $myuser;
            $isSerieLiked = $this->getAvisSerie($id, $myuser);


        } else {
            $user["authentificated"] = false;
        }

        $series = Serie::find($id);

        $episodes = Episode::select("saison", "nom", "numero", "urlImage")
            ->where("serie_id","=",$id)
            ->get();

        $saisons = $episodes->groupBy('saison');

        $comments = $series->comments()->get();

        return view('serie.show', compact("series", "saisons", "comments","user","isSerieLiked"));
    }

    public function saison($num_serie,$num_saison){
        $serie = Serie::find($num_serie);
        $saison = Episode::select("saison","nom","numero","urlImage")
            ->where("saison","=",$num_saison)
            ->where("serie_id","=",$num_serie)
            ->get();
        return view('saison.show',compact("serie","num_saison","saison"));
    }

    public function episode($num_serie,$numero) {

        // find the serie
        $serie = Serie::find($num_serie);

        if (!is_null($serie)) {

            // find the episode from the series
            $episodes = $serie->episodes()->get();

            if ($numero > count($episodes) || $numero < 1 && !$episodes->isEmpty()) {
                return redirect('404');
            } else {
                // index = numéro d'épisode - 1
                $episode = $episodes->get($numero - 1);

                $previous = null; $next = null;

                if ($episodes->get($numero - 2))
                    // index précédent = numéro épisode - 2
                    $previous = $numero - 1;

                if ($episodes->get($numero))
                    // index suivant = numéro épisode
                    $next = $numero + 1;

                return view('episode.show', compact("serie", "episode", "previous", "next"));
            }
        }
        return redirect('404');
        // redirect to a 404
    }
}
