@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="border: 1px solid #dee2e6; border-radius: .25rem;">
        {{-- User List Panel --}}
        <div class="col-md-4" style="border-right: 1px solid #dee2e6;">
            <div class="card" style="border: none;">
                <div class="card-header bg-white" style="border-bottom: 1px solid #dee2e6;">
                    <h4 class="text-center">Messages</h4>
                </div>
                <div class="card-body" style="padding: 0; height: 600px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @foreach($users as $user)
                            <a href="{{ route('messages.show', $user->id) }}" class="list-group-item list-group-item-action {{ isset($receiver) && $receiver->id == $user->id ? 'active' : '' }}" style="cursor: pointer;">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    @if($user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="avatar" class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                                    @else
                                        <i class="fa-solid fa-user-circle fa-2x mr-3"></i>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        {{-- You can add last message preview here --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Chat Panel --}}
        <div class="col-md-8" style="padding: 0;">
            @if(isset($receiver))
                <div class="card" style="border: none; height: 100%;">
                    {{-- Chat Header --}}
                    <div class="card-header bg-white" style="border-bottom: 1px solid #dee2e6;">
                        <div class="d-flex align-items-center">
                             @if($receiver->profile_photo_path)
                                <img src="{{ asset('storage/' . $receiver->profile_photo_path) }}" alt="avatar" class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                            @else
                                <i class="fa-solid fa-user-circle fa-2x mr-3"></i>
                            @endif
                            <h5 class="mb-0">{{ $receiver->name }}</h5>
                        </div>
                    </div>

                    {{-- Chat Body --}}
                    <div id="chat-body" class="card-body" style="height: 500px; overflow-y: auto; display: flex; flex-direction: column;">
                        @if(isset($messages))
                            @foreach($messages as $message)
                                @if($message->sender_id == Auth::id())
                                    {{-- Outgoing Message --}}
                                    <div class="d-flex justify-content-end mb-3">
                                        <div class="bg-primary text-white rounded p-2">
                                            <p class="mb-0">{{ $message->body }}</p>
                                        </div>
                                        @if(Auth::user()->profile_photo_path)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="avatar" class="rounded-circle ml-3" style="width: 40px; height: 40px;">
                                        @else
                                            <i class="fa-solid fa-user-circle fa-2x ml-3"></i>
                                        @endif
                                    </div>
                                @else
                                    {{-- Incoming Message --}}
                                    <div class="d-flex justify-content-start mb-3">
                                        @if($receiver->profile_photo_path)
                                            <img src="{{ asset('storage/' . $receiver->profile_photo_path) }}" alt="avatar" class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                                        @else
                                            <i class="fa-solid fa-user-circle fa-2x mr-3"></i>
                                        @endif
                                        <div class="bg-light rounded p-2">
                                            <p class="mb-0">{{ $message->body }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    {{-- Chat Footer (Send Message Form) --}}
                    <div class="card-footer bg-white" style="border-top: 1px solid #dee2e6;">
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                            <div class="input-group">
                                <input type="text" name="body" class="form-control" placeholder="Type a message..." style="border: none;" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-link" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                {{-- Placeholder when no user is selected --}}
                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                    <div class="text-center">
                        <i class="fa-solid fa-comments fa-5x text-muted"></i>
                        <h4 class="mt-3">Select a conversation</h4>
                        <p class="text-muted">Choose someone from your message list to start chatting.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .mr-3 {
        margin-right: 1rem !important;
    }
    .ml-3 {
        margin-left: 1rem !important;
    }
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    a.list-group-item {
        color: #212529;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-scroll to the bottom of the chat
    const chatBody = document.getElementById('chat-body');
    if(chatBody){
        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>
@endpush

