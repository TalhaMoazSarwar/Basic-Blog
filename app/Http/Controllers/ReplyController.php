<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Reply;
use Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $comment->replies()->create([
            'text' => $request->get('reply'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.show', ['post' => $comment->commentable, '#comment-id-' . $comment->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $reply->update([
            'text' => $request->get('reply')
        ]);

        return redirect()->route('post.show', ['post' => $reply->comment->commentable, '#reply-id-' . $reply->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }

    public function like(Reply $reply) {
        return Like::like_or_dislike($reply, true);
    }
    
    public function dislike(Reply $reply) {
        return Like::like_or_dislike($reply, false);
    }
}
