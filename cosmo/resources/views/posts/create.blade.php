@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary"> {{-- Card jadi dark --}}
                <div class="card-header bg-secondary text-white">Create New Post</div> {{-- Header digelapkan --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="caption" class="form-label text-white">Caption</label>
                            <textarea id="caption" class="form-control bg-dark text-white border-secondary @error('caption') is-invalid @enderror" name="caption" rows="3">{{ old('caption') }}</textarea>
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label text-white">Image</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-light">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
