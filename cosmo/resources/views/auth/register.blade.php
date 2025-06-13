@extends('layouts.guest')

@section('content')
<link href="{{ asset('css/authh.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card bg-dark text-white">
                <div class="card-header text-center bg-dark text-white">Register</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alertttt">
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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-white">Name</label>
                            <div class="col-md-6">
                                <input id="name"
                                       type="text"
                                       class="form-control bg-secondary text-white border-0"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                       autocomplete="name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end text-white">Username</label>
                            <div class="col-md-6">
                                <input id="username"
                                       type="text"
                                       class="form-control bg-secondary text-white border-0"
                                       name="username"
                                       value="{{ old('username') }}"
                                       required
                                       autocomplete="username">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white">Email Address</label>
                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control bg-secondary text-white border-0"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white">Password</label>
                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control bg-secondary text-white border-0"
                                       name="password"
                                       required
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control bg-secondary text-white border-0"
                                       name="password_confirmation"
                                       required
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
