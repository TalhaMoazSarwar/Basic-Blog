@extends('layouts.app')

@section('title', 'Posts');

@section('content')
    <div class="row align-items-center clearfix">
        <div class="col-9">
            <h1 class="mb-n3">POSTS</h1>
        </div>
        <div class="col-3">
            @auth
                <a class="btn btn-outline-success float-right" href="{{ route('post.create') }}">Create Post</a>
            @endauth
        </div>
    </div>
    <hr>
    @foreach ($posts as $post)
        <div class="card mb-2">
            <div class="card-body">
                <h4 class="text-uppercase"><a class="text-decoration-none text-reset" href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a></h4>
                <span style="font-size: 0.85rem" class="text-secondary text-uppercase">By <strong>{{ $post->user->name }}</strong> on <strong>{{ $post->created_at }}</strong></span>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection