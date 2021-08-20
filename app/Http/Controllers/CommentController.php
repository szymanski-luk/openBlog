<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contents' => ['required', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();

        $comment->content = $request->contents;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;

        $comment->save();

        return redirect()->route('post_detailed', ['id' => $request->post_id]);
    }
}
