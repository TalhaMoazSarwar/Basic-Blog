<?php

namespace App\Http\Controllers;

use App\Events\NewPostEvent;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('post.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);

        $post = Auth::user()->posts()->create($data);

        event(new NewPostEvent($post));

        return redirect()->route('post.show', ['post' => $post])->with('success', 'Post Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $like = $this->is_liked_or_disliked($post);
        return view('post.show', compact('post', 'like'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            return redirect()->route('post.index')->with('error', 'Unauthorized Access!');
        }
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $this->validator($request);

        $post->update($data);

        return redirect()->route('post.show', ['post' => $post])->with('success', 'Post Successfully Updated');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('post.index')->with('success', 'Post Successfully Deleted');
    }

    private function validator($request) {
        return $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
    }

    public function like(Post $post) {
        return Like::like_or_dislike($post, true);
    }
    
    public function dislike(Post $post) {
        return Like::like_or_dislike($post, false);
    }

    private function is_liked_or_disliked($post) {
        $like = $post->likes()->where('user_id', Auth::id())->first();
        if (!is_null($like)) {
            return $like->type;
        }
    }
}
