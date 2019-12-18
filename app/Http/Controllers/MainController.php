<?php

namespace App\Http\Controllers;

use App\Serie;
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
}
