@extends('layouts.app')

@section('content')

<div class="right-bg-image"></div>
<img src="{{ asset('/astronots.png') }}" alt="Floating Astronaut" class="floating-astronaut">


<div class="container py-4" >
    <div class="row justify-content-center">
        <div class="col-md-7">
        <h2 class="mb-4 text-center dosis-title">Let's see what your friends</h2>
        <h2 class="mb-4 text-center dosis-title">are up to!</h2>
        @forelse ($posts as $post)
        <div class="card mb-4 mx-auto"
             style="background-color: #1a1a1a; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px;">
            <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <img
                    src="{{ $post->user && $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('user-placeholder.png') }}"
                    alt="{{ $post->user->username ?? 'Deleted User' }}"
                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;"
                >
                <strong>
                    @if($post->user)
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-white">
                            {{ $post->user->username }}
                        </a>
                    @else
                        <span class="text-white">Deleted User</span>
                    @endif
                </strong>

                @if(auth()->id() === $post->user_id)
                    <div class="dropdown ms-auto">
                        <button class="btn btn-link text-white" type="button" id="postOptions{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="postOptions{{ $post->id }}">
                            <li>
                                <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">Delete</button>
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
                        class="img-fluid rounded mb-2"
                        style="max-height: 400px; width: 100%; object-fit: cover;"
                    >
                @endif

                <p>
                    @if($post->user)
                        <strong>{{ $post->user->username }}</strong>
                    @endif
                    {{ $post->caption }}
                </p>

                <div class="d-flex align-items-center mt-2">
                    @if($post->likes->where('user_id', auth()->id())->count() > 0)
                        <form action="{{ route('likes.destroy', $post->id) }}" method="POST" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 text-white">
                                <i class="fas fa-heart text-danger"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('likes.store', $post->id) }}" method="POST" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                    @endif

                    <span><strong>{{ $post->likes->count() }} likes</strong></span>
                </div>

                <div class="mt-3" style="max-height: 150px; overflow-y: auto;">
                    @foreach($post->comments as $comment)
                        <div class="d-flex mb-1 align-items-center">
                            <strong class="me-2">{{ $comment->user->username ?? 'Deleted User' }}</strong>
                            <span>{{ $comment->comment }}</span>

                            @if(auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ms-auto" onsubmit="return confirm('Delete this comment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" style="font-size: 1rem;">
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
                        <input type="text" name="comment" class="form-control" placeholder="Add a comment..." required>
                        <button class="btn btn-outline-primary" type="submit">Post</button>
                    </div>
                </form>

                <small class="text-muted d-block mt-2">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <p class="text-center">The galaxy is really quiet now...</p>
    @endforelse

    {{ $posts->links() }} {{-- pagination links --}}
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 80px;">
                            @if($suggestions->count())
            <div  style="position: fixed; right: 20px; width: 300px; z-index: 1000;">
                <div class="card mb-4" style="background-color: transparent; color: white; border-radius: 8px; border:none;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color:transparent; border:none;">
                        <strong>Suggestions For You</strong>
                    <a href="{{ route('suggestions.index') }}" class="text-decoration-none" style="color: #80dfff;">See All</a>
                    </div>
                    <ul class="list-group list-group-flush">
                       @foreach ($suggestions as $user)
                  <li class="list-group-item text-white d-flex justify-content-between align-items-center" style="background-color:transparent; border:none;">
                          <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-white d-flex align-items-center">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('user-placeholder.png') }}"
                        alt="{{ $user->username }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px; background-color:rgba(26, 26, 26, 0);">
                  <div>
                        <div>{{ $user->username }}</div>
                        <small class="text-white-50">Suggested for you</small>
                 </div>
             </a>
                <form action="{{ route('follow.store', $user->id) }}" method="POST">
                    @csrf
             <button class="btn btn-sm" style="color: #80dfff; border: 1px solid #80dfff;">Follow</button>
        </form>
</li>
@endforeach


                    </ul>
                </div>
            @endif
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
