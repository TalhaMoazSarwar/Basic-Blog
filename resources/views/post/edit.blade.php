@extends('layouts.app')

@section('title', 'Edit Post');

@section('content')
    <h1 class="display-4">Edit Post</h1>
    <hr>
    <form action="{{ route('post.update', ['post' => $post]) }}" method="post">
        @csrf
        @method('patch')
        @include('inc.post.form')
        <button class="btn btn-outline-success mt-3" type="submit">Update Post</button>
    </form>
@endsection