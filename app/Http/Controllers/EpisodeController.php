<?php


namespace App\Http\Controllers;

use App\Episodde;
use App\Episode;
use App\Serie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{

    public function see($id) {
        if ($myUser = Auth::user()) {
            $episode = Episode::all()->where("id", "=", $id);


            DB::table("seen")->insert(["user_id"=>$myUser->id, "episode_id"=>$id]);
            return redirect()->back();
        } else {
            echo "L'affichage de cette page n'est pas normal";
        }
        return redirect('404');
    }

}
