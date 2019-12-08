<?php

namespace App\Http\Controllers;

use App\Http\Resources\EpisodeResource;
use App\Http\Resources\SerieResource;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller {
    function index() {
        $series = Serie::all();
        return SerieResource::collection($series);
    }
    function saison(Request $request,$id, $num) {
        $numSaison = $request->get('saison', 1);
        $serie = Serie::findOrFail($id);
        return EpisodeResource::collection($serie->episodes()->where('saison',$num)->get());
    }
}
