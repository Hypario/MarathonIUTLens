<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SerieController extends Controller
{
    public function SeeSerie($id, $user) {
        // on récupére tous les épisodes de la-dite série
        $eps = Episode::all()
            ->where("serie_id","=",$id);

        // on récupére les infos sur l'utilisateur

        $vu = DB::table("seen")
            ->select("episode_id")
            ->where("user_id","=",$user->id)
            ->get();

        $dt = [];

        foreach ($vu as $v) {
            $dt[] = $v->episode_id;
        }

        foreach ($eps as $episode) {
            if (!in_array($episode->id,$dt)) {
                return false;
            }
        }
        return true;
    }

    public function SeenEpisode($idEpisode,  $user) {

     //   dd(Episode::all()->where("numero","=",$idE)->where("serie_id","=",$idS)->where("saison","=",$saison));
        $epi = Episode::all()->where("id","=",$idEpisode);

        $ep = $epi;

        foreach ($ep as $episode) {
            $epi = $ep;
        }

        $myUser = $user;

        $epliked = DB::table("seen")->select("*")->where("user_id","=",$myUser->id)->get();

        $dt = [];
        foreach ($epliked as $ep) {

            array_push($dt, $ep->episode_id);
        }


        foreach ($epi as $ep) {
            if (!in_array($ep->id, $dt)) {
                return false;
            } else {
                return true;
            }
        }



    }



    public function see($id) {
        if ($myUser = Auth::user()) {

            $episodes = Episode::all()->where("serie_id","=",$id);

            $epliked = DB::table("seen")->select("*")->where("user_id","=",$myUser->id)->get();

            $dt = [];
            foreach ($epliked as $ep) {
                array_push($dt, $ep->episode_id);
            }


            foreach ($episodes as $episode) {
                if (!in_array($episode->id, $dt)) {
                    DB::table("seen")->insert(["user_id"=>$myUser->id, "episode_id"=>$episode->id]);
                }
            }

            return redirect()->back();

        } else {
            echo "Cette action n'est pas censée arriver";

        }
        return redirect('404');
    }

    public function show($id) {

        $user = [];
        if ($myuser = Auth::user()) {
            $user["authentificated"] = true;
            $user["userdata"] = $myuser;
            $isSerieSeen = $this->SeeSerie($id, $myuser);


        } else {
            $user["authentificated"] = false;
        }

        $series = Serie::find($id);

        $episodes = Episode::select("saison", "nom", "numero", "urlImage")
            ->where("serie_id","=",$id)
            ->get();

        $saisons = $episodes->groupBy('saison');

        $comments = $series->comments()->get();

        return view('serie.show', compact("series", "saisons", "comments","user","isSerieSeen"));
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
                $user = [];
                if ($myuser = Auth::user()) {
                    $user["authentificated"] = true;
                   // $isEpisodeSeen = SeenEpisode(Episode::get($numero)->id,$myuser);
                    $isEpisodeSeen = $this->SeenEpisode($episode->id,$myuser);
                } else {
                    $user["authentificated"] = false;
                }

                return view('episode.show', compact("serie", "episode", "previous", "next", "user", "isEpisodeSeen"));
            }
        }
        return redirect('404');
        // redirect to a 404
    }
}
