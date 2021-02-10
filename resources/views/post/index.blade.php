@extends('layouts.app')

@section('title', 'Posts');

@section('content')
    <div class="container">
        <h1 class="display-4">Posts</h1>
        <hr>
        @foreach ($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                    <h3 class="text-uppercase font-weight-bold"><a class="text-decoration-none text-reset" href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a></h3>
                    <span class="lead text-secondary">By {{ $post->user->name }}</span>
                    <small class="text-muted float-right mt-n1 font-italic">Posted On: {{ $post->created_at }}</small>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection