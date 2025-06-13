@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/homee.css') }}">
<div class="right-bg-image"></div>
<img src="{{ asset('/astronots.png') }}" alt="Floating Astronaut" class="floating-astronaut">

<div class="container py-4">
    <div class="row justify-content-center">

        <div class="col-md-7">
            <h2 class="headingzzz">Let's see what your friends</h2>
            <h2 class="headingzzz">are up to!</h2>

            @forelse ($posts as $post)
                <div class="card mb-4 mx-auto card-custom">

                    <div class="card-header d-flex align-items-center">
                        <img
                            src="{{ $post->user && $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('user-placeholder.png') }}"
                            alt="{{ $post->user->username ?? 'Deleted User' }}"
                            class="profile-img">
                        <strong>
                            @if($post->user)
                                <a href="{{ route('profile.show', $post->user->id) }}" class="text-white-link">
                                    {{ $post->user->username }}
                                </a>
                            @else
                                <span class="text-white">Deleted User</span>
                            @endif
                        </strong>

                        @if (auth()->id() === $post->user_id)
                            <div class="dropdown ms-auto">
                                <button
                                    class="btn btn-link text-white"
                                    type="button"
                                    id="dropdownBtn{{ $post->id }}"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownBtn{{ $post->id }}">
                                    <li>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">Edit</a>
                                    </li>
                                    <li>
                                        <form
                                            action="{{ route('posts.destroy', $post->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('U sure u wanna delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="card-body text-white">
                        @if($post->image_path)
                            <img
                                src="{{ asset('storage/' . $post->image_path) }}"
                                alt="Post image"
                                class="post-imgg">
                        @endif

                        <p>
                            @if($post->user)
                                <strong>{{ $post->user->username }}</strong>
                            @endif
                            {{ $post->caption }}
                        </p>

                        <div class="interactsz">
                            @if ($post->likes->where('user_id', auth()->id())->count() > 0)
                                <form action="{{ route('likes.destroy', $post->id) }}" method="POST" class="like-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="batenznz">
                                        <i class="fas fa-heart heart-icon liked"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('likes.store', $post->id) }}" method="POST" class="like-form">
                                    @csrf
                                    <button type="submit" class="batenznz">
                                        <i class="far fa-heart heart-icon unliked"></i>
                                    </button>
                                </form>
                            @endif

                            <span><strong>{{ $post->likes->count() }} likes</strong></span>
                        </div>

                        <div class="mt-3 comment-section">
                            @foreach ($post->comments as $comment)
                                <div class="d-flex align-items-center mb-1">
                                    <strong class="me-2">
                                        {{ $comment->user->username ?? 'Deleted User' }}
                                    </strong>

                                    <span>{{ $comment->comment }}</span>

                                    @if (auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                                        <form
                                            action="{{ route('comments.destroy', $comment->id) }}"
                                            method="POST"
                                            class="ms-auto"
                                            onsubmit="return confirm('Delete this comment?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn batenznz">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="comment" class="form-control" placeholder="Add a comment...." required>
                                <button class="btn btn-outline-primary" type="submit">Post</button>
                            </div>
                        </form>

                        <small class="text-muted d-block mt-2">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>

            @empty
                <p class="text-center">The galaxy is really quiet now...</p>
            @endforelse

            {{ $posts->links() }}
        </div>

        <div class="col-md-4">
            <div class="sticky-wrapper">
                @if ($suggestions->count())
                    <div class="suggestions-container">
                        <div class="card suggestion-card">
                            <div class="card-header suggestion-header">
                                <strong>Suggestions For You</strong>
                                <a href="{{ route('suggestions.index') }}" class="see-all-link">See All</a>
                            </div>

                            <ul class="list-group list-group-flush">
                                @foreach ($suggestions as $user)
                                    <li class="list-group-item suggestion-item">
                                        <a href="{{ route('profile.show', $user->id) }}" class="suggestion-link">
                                            <img
                                                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('user-placeholder.png') }}"
                                                alt="{{ $user->username }}"
                                                class="suggestion-avatar">

                                            <div>
                                                <div>{{ $user->username }}</div>
                                                <small class="text-white-50">Suggested for you</small>
                                            </div>
                                        </a>

                                        <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-hover-blue">Follow</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
