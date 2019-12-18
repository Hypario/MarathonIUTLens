<?php


namespace App\Http\Controllers;

use App\Serie;

class SerieController extends Controller
{
    public function show($id) {

        $series = Serie::find($id);

        return view('serie.show',['series' => $series]);
    }
}