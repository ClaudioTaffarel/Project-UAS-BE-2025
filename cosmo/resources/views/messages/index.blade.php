@extends('layouts.app')

@section('content')
<link href="{{ asset('css/messagee.css') }}" rel="stylesheet">

<div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card bg-dark text-white">
                <div class="card-header bg-secondary text-white">
                    Your Conversations
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($users as $user)
                        <li class="list-group-item bg-dark text-white">
                            <a href="{{ route('messages.show', $user->id) }}"
                               class="text-white text-decoration-none d-flex align-items-center">
                                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('user-placeholder.png') }}"
                                     class="rounded-circle me-2"
                                     style="width: 32px; height: 32px; object-fit: cover;">
                                {{ $user->username }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card bg-dark text-white d-flex flex-column" style="height: 70vh;">
                @isset($receiver)
                    <div class="card-header bg-secondary text-white d-flex align-items-center">
                        <img src="{{ $receiver->profile_image ? asset('storage/' . $receiver->profile_image) : asset('user-placeholder.png') }}"
                            class="rounded-circle me-2"
                            style="width: 32px; height: 32px; object-fit: cover;">
                        <strong>{{ $receiver->username }}</strong>
                    </div>

                    <div class="flex-grow-1 overflow-auto px-3 py-2 chat-thread" id="chat-thread">
                        @foreach($messages as $message)
                            @if ($message->sender_id == auth()->id())
                                {{-- Authenticated user's message (right) --}}
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="text-end">
                                        <strong class="text-white d-block mb-1">{{ $message->sender->username }}</strong>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="me-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">&times;</button>
                                            </form>
                                            <div class="bg-primary text-white rounded p-2 chat-bubble">
                                                {{ $message->body }}
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <img src="{{ $message->sender->profile_image ? asset('storage/' . $message->sender->profile_image) : asset('user-placeholder.png') }}"
                                         alt="avatar"
                                         class="rounded-circle ms-2"
                                         style="width: 32px; height: 32px; object-fit: cover;">
                                </div>
                            @else
                                {{-- Other user's message (left) --}}
                                <div class="d-flex mb-3">
                                    <img src="{{ $message->sender->profile_image ? asset('storage/' . $message->sender->profile_image) : asset('user-placeholder.png') }}"
                                         alt="avatar"
                                         class="rounded-circle me-2"
                                         style="width: 32px; height: 32px; object-fit: cover;">
                                    <div>
                                        <strong class="text-white d-block mb-1">{{ $message->sender->username }}</strong>
                                        <div class="bg-secondary text-white rounded p-2 mb-1 chat-bubble">
                                            {{ $message->body }}
                                        </div>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="card-footer bg-dark border-top sticky-bottom">
                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                            <div class="input-group">
                                <input type="text" name="body" class="form-control" placeholder="Type a message..." autocomplete="off" required>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <p class="text-white">Select a conversation to start chatting.</p>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection
