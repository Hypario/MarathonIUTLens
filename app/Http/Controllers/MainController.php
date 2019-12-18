<?php

namespace App\Http\Controllers;

use App\Serie;
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

    public function random()
    {
        $series = Serie::inRandomOrder()->get();

        return view("index", compact("series"));
    }

    public function popular()
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

}
