<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use http\Client\Curl\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SerieController extends Controller
{

    public function see($id)
    {
        if ($myUser = Auth::user()) {

            $episodes = Episode::all()->where("serie_id", "=", $id);

            $epliked = DB::table("seen")->select("*")->where("user_id", "=", $myUser->id)->get();

            $dt = [];
            foreach ($epliked as $ep) {
                array_push($dt, $ep->episode_id);
            }


            foreach ($episodes as $episode) {
                if (!in_array($episode->id, $dt)) {
                    DB::table("seen")->insert(["user_id" => $myUser->id, "episode_id" => $episode->id]);
                }
            }

            return redirect()->back();

        } else {
            echo "Cette action n'est pas censée arriver";

        }
        return redirect('404');
    }

    public function show($id)
    {
        if ($myuser = Auth::check()) {
            $isSerieSeen = $this->SeeSerie($id);
        } else {
            $isSerieSeen = null;
        }

        $series = Serie::find($id);

        $episodes = Episode::select("saison", "nom", "numero", "urlImage")
            ->where("serie_id", "=", $id)
            ->get();

        $saisons = $episodes->groupBy('saison');

        $comments = $series->comments()->get();

        return view('serie.show', compact("series", "saisons", "comments", "isSerieSeen"));
    }

    public function saison($num_serie, $num_saison)
    {
        $serie = Serie::find($num_serie);
        $saison = Episode::select("saison", "nom", "numero", "urlImage")
            ->where("saison", "=", $num_saison)
            ->where("serie_id", "=", $num_serie)
            ->get();
        return view('saison.show', compact("serie", "num_saison", "saison"));
    }

    public function episode($num_serie, $numero)
    {
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

                $previous = null;
                $next = null;

                if ($episodes->get($numero - 2))
                    // index précédent = numéro épisode - 2
                    $previous = $numero - 1;

                if ($episodes->get($numero))
                    // index suivant = numéro épisode
                    $next = $numero + 1;
                $user = [];
                if ($myuser = Auth::user()) {
                    $isEpisodeSeen = $this->SeenEpisode($episode->id);
                } else {
                    $isEpisodeSeen = null;
                }

                return view('episode.show', compact("serie", "episode", "previous", "next", "user", "isEpisodeSeen"));
            }
        }
        return redirect('404');
        // redirect to a 404
    }

    private function SeeSerie($id): bool
    {
        $seen = Auth::user()->seen()->get();
        $serie = Serie::find($id);
        foreach ($serie->episodes as $episode) {
            if (!$seen->find($episode)) {
                return false;
            }
        }
        return true;
    }

    private function SeenEpisode($idEpisode): bool
    {
        $episodes = Auth::user()->seen()->get();

        if ($episodes->find($idEpisode))
            return true;
        return false;
    }

    public function modif_avis($id) {
        // id c'est l'identifiant de la série

        // on importe la série
        $serie = Serie::find($id);
        if (!is_null($serie)) {



        if ($user = Auth::user())
            return view("serie.avis",["serie"=>$serie]);




        }
            return redirect("404");

    }

    public function send_avis(Request $request, $id) {




    }
}
