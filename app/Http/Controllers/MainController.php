<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Serie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Landing page !
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $series = Serie::all();

        return view("index", compact("series"));
    }

    /**
     * Random series showed in the landing page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function random()
    {
        $series = Serie::inRandomOrder()->get();

        return view("index", compact("series"));
    }

    /**
     * Popular series showed in the landing page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function popular()
    {
        $series = DB::table("series")
            ->select(DB::raw("Count(*) as vues_count, series.id, series.nom, series.resume"))
            ->join("episodes", "series.id", "=", "episodes.serie_id")
            ->join("seen", "episodes.id", "=", "seen.episode_id")
            ->groupBy( "series.id", "series.nom", "series.resume")
            ->orderBy("vues_count", "desc")
            ->get();

        return view("index", compact("series"));
    }

    /**
     * Most reviewed series in the landing page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function reviews() {

        $retour = Serie::withCount('comments')->orderBy('comments_count', 'desc')->get();

        return view("reviews", compact("retour"));
    }

    public function  user() {
        if ($user = Auth::user()) {

            $data = array();
            $data["user"] = $user;

            $data["stats"] = array();

            // récupération nbr de épisodes vu ...
            $data["stats"]["epvu"] = DB::select(DB::raw("SELECT COUNT(*) AS nb FROM seen WHERE user_id=".$user->id))[0]->nb;

            // récupération nbr de commentaires
            $data["stats"]["nbcomm"] = Comment::where("user_id","=",$user->id)->count("*");

            // Récupération commentaires
            $data["comments"] = Comment::where("user_id","=",$user->id)->select("*")->get();

            // Récupération durée passée
            $data["stats"]["duree"] = DB::select(DB::raw("SELECT SUM(duree)/60 AS somme FROM episodes JOIN seen ON episodes.id = seen.user_id WHERE seen.user_id = ".$user->id))[0]->somme;

            return view("auth.user", compact("data"));
        } else {
            return view("auth.login");
        }

    }





}
