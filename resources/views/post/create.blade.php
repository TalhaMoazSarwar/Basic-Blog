@extends('layouts.app')

@section('title', 'Create Post');

@section('content')
    <h1 class="display-4">Create Post</h1>
    <hr>
    <form action="{{ route('post.store') }}" method="post">
        @csrf
        @include('inc.post.form')
        <button class="btn btn-outline-success mt-3" type="submit">Create Post</button>
    </form>

    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection