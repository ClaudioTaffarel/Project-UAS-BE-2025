@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" style="width:100%; height:auto;">
        </div>

        <div class="col-md-4">
            <div class="d-flex align-items-center mb-3">
                @if($post->user)
                    <img src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('user-placeholder.png') }}"
                         class="rounded-circle me-3"
                         style="width: 40px; height: 40px; object-fit: cover;">
                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-light text-decoration-none">
                        <strong>{{ $post->user->username }}</strong>
                    </a>

                    @if(auth()->id() === $post->user_id || (auth()->check() && auth()->user()->isAdmin()))

                        <div class="dropdown ms-auto">
                            <button class="btn btn-link text-light" type="button" id="postOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="postOptions">
                                <li>
                                    <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <img src="{{ asset('user-placeholder.png') }}" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                    <span class="text-muted">Deleted User</span>
                @endif
            </div>

            @if($post->user)
                <p><strong>{{ $post->user->username }}</strong> {{ $post->caption }}</p>
            @else
                <p>{{ $post->caption }}</p>
            @endif

            <hr>

            <div class="d-flex align-items-center mb-2">
                @if($post->likes->where('user_id', auth()->id())->count() > 0)
                    <form action="{{ route('likes.destroy', $post->id) }}" method="POST" class="me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0">
                            <i class="fas fa-heart text-danger"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('likes.store', $post->id) }}" method="POST" class="me-2">
                        @csrf
                        <button type="submit" class="btn btn-link p-0">
                            <i class="far fa-heart"></i>
                        </button>
                    </form>
                @endif
                <span class="text-white"><strong>{{ $post->likes->count() }} likes</strong></span>
            </div>

            <p class="text-white">{{ $post->created_at->format('F d, Y') }}</p>

            <hr>
            <div class="comments-section" style="max-height: 300px; overflow-y: auto;">
                @foreach($post->comments as $comment)
                    <div class="d-flex mb-2">
                        @if($comment->user)
                            <img src="{{ $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : asset('user-placeholder.png') }}"
                                 class="rounded-circle me-2"
                                 style="width: 32px; height: 32px; object-fit: cover;">
                            <strong class="me-2 text-white">{{ $comment->user->username }}</strong>
                        @else
                            <img src="{{ asset('user-placeholder.png') }}"
                                 class="rounded-circle me-2"
                                 style="width: 32px; height: 32px; object-fit: cover;">
                            <strong class="me-2 text-white">Deleted User</strong>
                        @endif
                        <p class="mb-0 text-white">{{ $comment->comment }}</p>

                        @if(auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ms-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 text-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <hr>

            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="comment" class="form-control" placeholder="Add a comment..." required>
                    <button class="btn btn-outline-primary" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
