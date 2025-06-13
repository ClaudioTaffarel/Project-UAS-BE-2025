@extends('layouts.app')

@section('content')
<link href="{{ asset('css/authh.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header bg-secondary text-white">Edit Profile</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alerttt mb-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alertsucc mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Name</label>
                            <input id="name"
                                   type="text"
                                   class="form-control bg-dark text-white border-secondary"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label text-white">Username</label>
                            <input id="username"
                                   type="text"
                                   class="form-control bg-dark text-white border-secondary"
                                   name="username"
                                   value="{{ old('username', $user->username) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label text-white">Bio</label>
                            <textarea id="bio"
                                      class="form-control bg-dark text-white border-secondary"
                                      name="bio"
                                      rows="3">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label text-white" id="profile_image" name="profile_image">Profile Image</label>
                            <input id="profile_image"
                                   type="file"
                                   class="form-control bg-dark text-white border-secondary"
                                   name="profile_image">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-light">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
