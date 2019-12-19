<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SerieController extends Controller
{

    public function see($id)
    {
        if (Auth::check()) {
            $series = Serie::all();

            if ($series->find($id) && !$this->SeenSerie($id)) {
                $episodes = Serie::find($id)->episodes()->get();
                Auth::user()->seen()->syncWithoutDetaching($episodes);
            }
            return redirect()->back();
        }
        return redirect('404');
    }

    public function show($id)
    {
        if ($myuser = Auth::check()) {
            $isSerieSeen = $this->SeenSerie($id);
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

    private function SeenSerie($id): bool
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
        $this->middleware('auth')->except('upload');
        $serie= Serie::find($id);

        $serie->avis = $request->avis;
        $file = $request->file('file_up');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/uploads/';
        $newurl =  $file->move($path, $filename);

        $serie->urlAvis = str_replace(public_path(),"",$newurl);

        $serie->save();

        return redirect(route("serie.show",$id));

    }
}
