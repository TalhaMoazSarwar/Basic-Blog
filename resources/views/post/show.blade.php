@extends('layouts.app')

@section('title', $post->title);

@php
    function is_liked_or_disliked($model) {
        $like = $model->likes()->where('user_id', Auth::id())->first();
        if (!is_null($like)) {
            return $like->type;
        }
    }
@endphp

@section('content')
    @include('inc.post.breadcrumb')
    <div class="card">
        <div class="card-body">
            @auth
                <div class="post-likebox float-right" data-post-id="{{ $post->id }}">
                    <button type="button" class="btn post-like {{ is_liked_or_disliked($post) === 1 ? 'btn-success' : 'btn-outline-success' }}">
                        <i class="far fa-thumbs-up fa-lg"></i> <span>{{ is_liked_or_disliked($post) === 1 ? 'Liked' : 'Like' }}</span>
                    </button>
                    <button type="button" class="btn post-dislike {{ is_liked_or_disliked($post) === 0 ? 'btn-danger' : 'btn-outline-danger' }}">
                        <i class="far fa-thumbs-down fa-lg"></i> <span>{{ is_liked_or_disliked($post) === 0 ? 'Disliked' : 'Dislike' }}</span>
                    </button>
                </div>
            @endauth
            <h3 class="card-title text-uppercase font-weight-bold">{{ $post->title }}</h3>
            <span class="card-subtitle text-muted">By <span class="post-author-active">{{ $post->user->name }}</span> on {{ $post->created_at->toFormattedDateString() }}</span>
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