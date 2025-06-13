@extends('layouts.app')

@section('content')
<link href="{{ asset('css/profilee.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <img
                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/user-placeholder.png') }}"
                class="profile-avatar">
        </div>

        <div class="col-md-9">
            <div class="d-flex align-items-center">
                <h1>{{ $user->username }}</h1>

                @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline-light ms-4">Edit Profile</a>
                @else
                    <div class="ms-4">
                        @if(auth()->user()->isFollowing($user->id))
                            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-light">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex mt-3">
                <div class="me-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="me-4"><strong>{{ $user->followers()->count() }}</strong> followers</div>
                <div><strong>{{ $user->following()->count() }}</strong> following</div>
            </div>

            <div class="mt-3">
                <h5>{{ $user->name }}</h5>
                <p>{{ $user->bio }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-5 row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($user->posts as $post)
            <div class="col">
                <a href="{{ route('posts.show', $post->id) }}">
                    <div class="post-thumbnail-wrapper">
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                             alt="Post Image"
                             class="post-thumbnail-img">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
