@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary"> {{-- Tambahkan class bg-dark & text-white --}}
                <div class="card-header bg-secondary text-white">Edit Post</div> {{-- Ubah header juga biar kontras --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="caption" class="form-label text-white">Caption</label>
                            <textarea id="caption" class="form-control bg-dark text-white border-secondary @error('caption') is-invalid @enderror" name="caption" rows="3">{{ old('caption', $post->caption) }}</textarea>
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-light">Update Post</button> {{-- Ganti warna tombol --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
