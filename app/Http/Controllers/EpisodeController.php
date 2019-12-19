<?php


namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{

    public function see($id)
    {
        if (Auth::check()) {
            if ($episode = Episode::find($id)) {
                DB::table("seen")->insert(["user_id" => Auth::user()->id, "episode_id" => $id]);
            }
            return redirect()->back();
        }
        return redirect('404');
    }

}
