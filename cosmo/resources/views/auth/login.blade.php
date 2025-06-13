@extends('layouts.guest')

@section('content')
<link href="{{ asset('css/authh.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card bg-dark text-white">
                <div class="card-header bg-dark text-white text-center">Login</div>

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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white">Email Address</label>

                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control bg-secondary text-white border-0"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="email"
                                       autofocus>
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
                                       autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="center-actions">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a class="btn btn-link text-white" href="{{ route('manual.reset.form') }}">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
