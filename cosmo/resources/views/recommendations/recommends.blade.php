@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Recommended for You</h1>

    @if($posts->count())
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($post->image_url)
                            <img src="{{ $post->image_url }}" class="card-img-top" alt="Post image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No recommendations available right now.</p>
    @endif
@endsection
