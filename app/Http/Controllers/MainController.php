<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use App\User;
use Illuminate\Foundation\Console\Presets\Vue;
use Illuminate\Http\Request;

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

    public function popular(){
        //tri des series par les plus vue
        $series = Serie::all();
        $episodes = Episode::all();


        return view("popular",compact("series"));
    }
}
