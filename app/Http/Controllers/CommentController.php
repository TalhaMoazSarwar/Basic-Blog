<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = $post->comments()->create([
            'text' => $request->get('comment'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.show', ['post' => $post, '#comment-id-' . $comment->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update([
            'text' => $request->get('comment')
        ]);

        return redirect()->route('post.show', ['post' => $comment->commentable, '#comment-id-' . $comment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        $comment->replies()->delete();
        return redirect()->route('post.show', ['post' => $comment->commentable])->with('success', 'Comment Successfully Deleted');
    }

    public function like(Comment $comment) {
        return Like::like_or_dislike($comment, true);
    }
    
    public function dislike(Comment $comment) {
        return Like::like_or_dislike($comment, false);
    }
}
