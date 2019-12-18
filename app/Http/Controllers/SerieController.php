<?php


namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use App\User;
use Illuminate\Foundation\Console\Presets\Vue;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function show($id) {

        //$action = $request->query('action', 'show');
        $series = Serie::find($id);

        return view('serie.show',['series' => $series,/*'action' => $action*/]);
    }
}