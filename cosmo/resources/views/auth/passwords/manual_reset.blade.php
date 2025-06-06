manual_resetblade.php
@extends('layouts.guest') {{-- Ini asumsi kamu pakai layout bawaan --}}

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Manual Password Reset</h4>

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

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" required class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Pengguna</label>
                    <input type="email" name="email" required class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" required class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="form-control form-control-sm">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection