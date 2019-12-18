<?php

namespace App\Http\Controllers;

use App\Serie;

class MainController extends Controller
{
    /**
     * Landing page !
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $series = Serie::all();

        return view("index", compact("series"));
    }

    public function random() {
        $series = Serie::inRandomOrder()->get();

        return view("index", compact("series"));
    }

    public function reviews() {

        $retour = Serie::withCount('comments')->orderBy('comments_count', 'desc')->get();

        return view("reviews", compact("retour"));
    }

}
