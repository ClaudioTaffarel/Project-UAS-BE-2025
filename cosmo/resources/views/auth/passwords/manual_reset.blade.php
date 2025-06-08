
@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5"> {{-- Ukuran form agar lebih kecil --}}
            <div class="card bg-dark text-white"> {{-- Sesuai style register --}}
                <div class="card-header text-center bg-dark text-white">Manual Password Reset</div>

                <div class="card-body">
                    {{-- Tampilkan error jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Tampilkan success message jika ada --}}
                    @if (session('success'))
                        <div class="alert alert-success small">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('manual.reset.process') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end text-white">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" name="username" required class="form-control bg-secondary text-white border-0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white">Email Pengguna</label>
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" required class="form-control bg-secondary text-white border-0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white">Password Baru</label>
                            <div class="col-md-6">
                                <input id="password" type="password" name="password" required class="form-control bg-secondary text-white border-0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-white">Konfirmasi Password</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control bg-secondary text-white border-0">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
