@extends('layouts.app')

@section('title', $post->title);

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-uppercase font-weight-bold">{{ $post->title }}</h3>
            <span class="card-subtitle text-muted">By <strong>{{ $post->user->name }}</strong> on <strong>{{ $post->created_at }}</strong></span>
            <p class="card-text lead text-secondary mt-4">{!! $post->body !!}</p>
        </div>
    </div>
@endsection