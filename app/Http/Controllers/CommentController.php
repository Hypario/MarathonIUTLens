<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function create(Request $request, $idSerie) {
        $validated = $this->validate($request, [
            'content' => 'required',
            'note' => 'required|between:1,10'
        ]);

        if (Serie::find($idSerie)) {
            $comment = new Comment($validated);
            $comment->serie_id = $idSerie;
            $comment->user_id = Auth::user()->id;
            $comment->validated = false;

            $comment->save();
        }
        return redirect()->back();
    }

    public function valid($idComment) {
        /** @var Comment $comment */
        if ($comment = Comment::find($idComment)) {
            $comment->validated = true;

            $comment->update();
        }
        return redirect()->back();
    }

    public function reject($idComment) {
        /** @var Comment $comment */
        if ($comment = Comment::find($idComment)) {
            $comment->delete();
        }
        return redirect()->back();
    }

}
