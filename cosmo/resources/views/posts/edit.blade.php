@extends('layouts.app')

@section('content')
<link href="{{ asset('css/authh.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header bg-secondary text-white">Edit Your Post!</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alerttt">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alertsucc">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="caption" class="form-label text-white">Update your caption</label>
                            <textarea id="caption"
                                      class="form-control bg-secondary text-white border-0"
                                      name="caption"
                                      rows="3">{{ old('caption', $post->caption) }}</textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-outline-light">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
