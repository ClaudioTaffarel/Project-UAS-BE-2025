@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary"> {{-- Card jadi dark --}}
                <div class="card-header bg-secondary text-white">Edit Profile</div> {{-- Header juga digelapkan --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Name</label>
                            <input id="name" type="text" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label text-white">Username</label>
                            <input id="username" type="text" class="form-control bg-dark text-white border-secondary @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label text-white">Bio</label>
                            <textarea id="bio" class="form-control bg-dark text-white border-secondary @error('bio') is-invalid @enderror" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label text-white">Profile Image</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image">
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
