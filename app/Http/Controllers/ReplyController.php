<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    public function createReply(Request $request)
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

        $reply = new Reply();

        $reply->content = $request->contents;
        $reply->user_id = Auth::user()->id;
        $reply->post_id = $request->post_id;
        $reply->comment_id = $request->comment_id;

        $reply->save();

        return redirect()->route('post_detailed', ['id' => $request->post_id]);
    }
}
