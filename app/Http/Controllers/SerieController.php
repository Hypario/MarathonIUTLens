<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;

class SerieController extends Controller
{
    public function show($id) {

        $series = Serie::find($id);

        return view('serie.show',['series' => $series]);
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