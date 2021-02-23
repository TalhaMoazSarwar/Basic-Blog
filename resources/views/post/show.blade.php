@extends('layouts.app')

@section('title', $post->title);

@section('content')
    @include('inc.post.breadcrumb')
    <div class="card">
        <div class="card-body">
            @auth
                <div class="post-likebox float-right">
                    <button type="button" class="btn {{ $like === 1 ? 'btn-success' : 'btn-outline-success' }}" id="post-like">
                        <i class="far fa-thumbs-up fa-lg"></i> <span>{{ $like === 1 ? 'Liked' : 'Like' }}</span>
                    </button>
                    <button type="button" class="btn {{ $like === 0 ? 'btn-danger' : 'btn-outline-danger' }}"  id="post-dislike">
                        <i class="far fa-thumbs-down fa-lg"></i> <span>{{ $like === 0 ? 'Disliked' : 'Dislike' }}</span>
                    </button>
                </div>
            @endauth
            <h3 class="card-title text-uppercase font-weight-bold">{{ $post->title }}</h3>
            <span class="card-subtitle text-muted">By <strong>{{ $post->user->name }}</strong> on <strong>{{ $post->created_at }}</strong></span>
            <hr>
            <span class="card-text lead text-secondary">{!! $post->body !!}</span>
            @if (Auth::id() == $post->user_id)
                <form class="float-right" action="{{ route('post.destroy', ['post' => $post]) }}" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-outline-primary mr-2" href="{{ route('post.edit', ['post' => $post]) }}">Edit Post</a>
                    <input class="btn btn-outline-danger" type="submit" value="Delete Post">
                </form>
            @endif
        </div>
    </div>

    @include('inc.post.comment')
@endsection