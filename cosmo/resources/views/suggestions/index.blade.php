@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/suggest.css') }}">

<div class="container py-4 text-white">
    <h2 class="mb-4">Suggested Users</h2>

    @if($suggestions->count())
        <div class="row">
            @foreach($suggestions as $user)
                <div class="col-md-6 mb-3">
                    <div class="suggestion-card d-flex align-items-center bg-dark p-3 rounded shadow-sm">
                        <img
                            src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('user-placeholder.png') }}"
                            alt="{{ $user->username }}"
                            class="suggestion-avatar">
                        <div class="flex-grow-1">
                            <div><strong>{{ $user->username }}</strong></div>
                            <small class="text-muted">Suggested for you</small>
                        </div>
                        <form action="{{ route('follow.store', $user) }}" method="POST" class="follow-form">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No suggestions found!!</p>
    @endif
</div>
@endsection
