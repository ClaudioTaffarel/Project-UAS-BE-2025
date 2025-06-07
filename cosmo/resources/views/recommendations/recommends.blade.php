@extends('layouts.app')

@section('content')

<div style="max-width: 500px; position: relative; margin-bottom: 1rem;">
    <form method="GET" action="{{ route('users.search') }}" style="display: flex;">
        <input
            type="text"
            name="query"
            value="{{ old('query', $query ?? '') }}"
            class="form-control"
            placeholder="Search for other Astronauts..."
            autocomplete="off"
            style="background-color: #808080 !important; color: white;"
        >
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Search</button>
    </form>

    @if(!empty($query))
        <div style="
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            margin-top: 5px;
        ">
            @if($users->count())
                @foreach($users->take(3) as $user)
                    <a href="{{ route('profile.show', $user->id) }}" style="text-decoration: none; color: black;">
                        <div style="padding: 10px; display: flex; align-items: center; border-bottom: 1px solid #eee;">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-profile.png') }}" 
                                 alt="{{ $user->username }}"
                                 style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                            <div>
                                <strong>{{ $user->username }}</strong><br>
                                <small>{{ $user->name }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p style="padding: 10px;">No users found.</p>
            @endif
        </div>
    @endif
</div>

<h1 class="mb-4 milkyway-title">Whats going on in the milky way style</h1>

<style>
    .milkyway-title {
        color: rgb(119, 178, 218);
    }
</style>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    @foreach ($posts as $post)
        <div class="col">
            <a href="{{ route('posts.show', $post->id) }}">
                <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 10px;">
                    <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://via.placeholder.com/250' }}"
                         alt="Post Image"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </a>
        </div>
    @endforeach
</div>

@endsection
