@extends('layouts.app')

@section('content')
<link href="{{ asset('css/exploree.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/homee.css') }}">

<div class="search-container">
    <form method="GET" action="{{ route('users.search') }}" class="search-form">
        <input
            type="text"
            name="query"
            value="{{ old('query', $query ?? '') }}"
            class="form-control search-input"
            placeholder="Search for other Astronauts..."
            autocomplete="off"
        >
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>

    @if(!empty($query))
        <div class="search-results">
            @if($users->count())
                @foreach($users->take(3) as $user)
                    <a href="{{ route('profile.show', $user->id) }}" class="search-result-item">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-profile.png') }}"
                             alt="{{ $user->username }}"
                             class="search-result-img">
                        <div>
                            <strong>{{ $user->username }}</strong><br>
                            <small>{{ $user->name }}</small>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="p-2">No users found.</p>
            @endif
        </div>
    @endif
</div>

<h2 class="headingzzz">Here's What's going on in the Milky Way!</h2>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    @foreach ($posts as $post)
        <div class="col">
            <a href="{{ route('posts.show', $post->id) }}">
                <div class="post-thumbnail-wrapper">
                    <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://via.placeholder.com/250' }}"
                         alt="Post Image"
                         class="post-thumbnail-img">
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
