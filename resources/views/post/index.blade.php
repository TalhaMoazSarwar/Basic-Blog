@extends('layouts.app')

@section('title', 'Posts');

@section('content')
    <div class="row align-items-center clearfix">
        <div class="col-9">
            <h1 class="display-4">Posts</h1>
        </div>
        <div class="col-3">
            <a class="btn btn-lg btn-outline-success float-right" href="{{ route('post.create') }}">Create Post</a>
        </div>
    </div>
    <hr>
    @foreach ($posts as $post)
        <div class="card mb-2">
            <div class="card-body">
                <h3 class="text-uppercase font-weight-bold"><a class="text-decoration-none text-reset" href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a></h3>
                <span style="font-size: 1rem" class="text-secondary">By <strong>{{ $post->user->name }}</strong> on <strong>{{ $post->created_at }}</strong></span>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection