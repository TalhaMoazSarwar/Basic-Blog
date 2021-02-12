@extends('layouts.app')

@section('title', $post->title);

@section('content')
    @include('inc.post.breadcrumb')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-uppercase font-weight-bold">{{ $post->title }}</h3>
            <span class="card-subtitle text-muted">By <strong>{{ $post->user->name }}</strong> on <strong>{{ $post->created_at }}</strong></span>
            <hr>
            <p class="card-text lead text-secondary">{!! $post->body !!}</p>
            <form class="float-right" action="{{ route('post.destroy', ['post' => $post]) }}" method="post">
                @csrf
                @method('delete')
                <a class="btn btn-outline-primary mr-2" href="{{ route('post.edit', ['post' => $post]) }}">Edit Post</a>
                <input class="btn btn-outline-danger" type="submit" value="Delete Post">
            </form>
        </div>
    </div>
@endsection