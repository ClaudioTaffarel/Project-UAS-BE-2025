@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <img
                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/150' }}"
                class="rounded-circle"
                style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <div class="col-md-9">
            <div class="d-flex align-items-center">
                <h1>{{ $user->username }}</h1>

                @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline-secondary ms-4">Edit Profile</a>
                @else
                    <div class="ms-4">
                        @if(auth()->user()->isFollowing($user->id))
                            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-light">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="POST">
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

    <div class="row mt-5">
        @foreach($user->posts as $post)
            <div class="col-md-4 mb-4">
                <a href="{{ route('posts.show', $post->id) }}">
                  <img src="{{ asset('storage/' . $post->image_path) }}" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

