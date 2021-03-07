@extends('layouts.app')

@section('title', $user->name . "'s Profile");

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

    <div class="card mt-2">
        <div class="card-body">
            <h2 class="font-weight-bold text-secondary font-underline">Recent Activity</h2>
            <div>

            </div>
        </div>
    </div>
@endsection