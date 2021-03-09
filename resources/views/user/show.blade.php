@extends('layouts.app')

@section('title', $user->name . "'s Profile");

@php
    function is_liked_or_disliked($model) {
        $like = $model->likes()->where('user_id', Auth::id())->first();
        if (!is_null($like)) {
            return $like->type;
        }
    }
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row align-items-center justify-content-around">
                <div class="mr-5">
                    <img class="rounded-circle img-thumbnail" src="/storage/images/profile/{{ $user->profile_image }}" alt="Profile Picture" width="256" height="256">
                </div>
                <div class="text-secondary">
                    <h1 class="display-4">{{ $user->name }}</h1>
                    <h3 class="ml-2 mb-4">{{ $user->email }}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Posts:</p><span class="lead"> {{ $user->posts_count }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Posts Likes:</p><span class="lead"> {{ $user->posts_likes_count }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Total Comments:</p><span class="lead"> {{ $user->comments_count }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Total Replies:</p><span class="lead"> {{ $user->replies_count }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Total Likes:</p><span class="lead"> {{ $user->likes_count }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="lead little-bold d-inline-block">Total Dislikes:</p><span class="lead"> {{ $user->dislikes_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent_posts card mt-2">
        <div class="card-body">
            <h2 class="font-weight-bold text-secondary font-underline">Recent Posts</h2>
            <div class="d-flex flex-column">
                @foreach ($user->posts as $post)
                    <div class="border p-3 my-2 text-justify text-secondary">
                        <h5 class="font-weight-bold d-inline"><a class="text-reset text-decoration-none" href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a></h5>
                        <small class="text-muted"> ({{ $post->age }})</small>
                        @auth
                            <div class="post-actionbox mt-2" data-post-id="{{ $post->id }}">
                                <a class="user-post-like {{ is_liked_or_disliked($post) === 1 ? 'text-success' : '' }}">
                                    <i class="far fa-thumbs-up"></i>
                                    <span class="action-text">{{ is_liked_or_disliked($post) === 1 ? 'Liked' : 'Like' }}</span>
                                    (<span class="action-count">{{ $post->likes->where('type', 1)->count() }}</span>)
                                </a>
                                <a class="user-post-dislike ml-3 {{ is_liked_or_disliked($post) === 0 ? 'text-danger' : '' }}">
                                    <i class="far fa-thumbs-down"></i>
                                    <span class="action-text">{{ is_liked_or_disliked($post) === 0 ? 'Disliked' : 'Dislike' }}</span>
                                    (<span class="action-count">{{ $post->likes->where('type', 0)->count() }}</span>)
                                </a>
                                <a href="{{ route('post.show', ['post' => $post, '#post-commentbox']) }}" class="user-post-comment ml-3">
                                    <i class="far fa-thumbs-down"></i>
                                    <span class="action-text">Comment</span>
                                    (<span class="action-count">{{ $post->comments->count() }}</span>)
                                </a>
                            </div>
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection