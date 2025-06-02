@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary">Welcome back, {{ auth()->user()->name }}!</h2>

    <div class="card mb-4">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    @forelse ($posts as $post)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center">
                <img 
                    src="{{ $post->user->profile_image_url ?? asset('user-placeholder.png') }}" 
                    alt="{{ $post->user->name }}" 
                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;"
                >
                <strong>{{ $post->user->name }}</strong> posted:
            </div>
            <div class="card-body">
                <p>{{ $post->caption }}</p>
                
                @if($post->image_path)
                    <img 
                        src="{{ asset('storage/' . $post->image_path) }}" 
                        alt="Post image" 
                        class="img-fluid rounded"
                        style="max-height: 400px;"
                    >
                @endif
                
                <small class="text-muted d-block mt-2">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <p>No posts from people you follow yet.</p>
    @endforelse

    {{ $posts->links() }} {{-- pagination links --}}
</div>
@endsection
