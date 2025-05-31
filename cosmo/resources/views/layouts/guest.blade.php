<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cosmo') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Background video styling */
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
            opacity: 0.4;
        }

        /* Overlay for readability */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(18, 18, 18, 0.6);
            z-index: -1;
        }

        body {
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-brand img {
            height: 60px;
        }

        .overlay-top-img {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999; /* paling tinggi */
            width: auto;
            max-width: 100%;
            height: auto;
            pointer-events: none; /* supaya nggak ganggu klik */
        }
    </style>
</head>
<body>
    {{-- Background Video and Overlay --}}
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('spacevid2.mp4') }}" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <img src="{{ asset('doodles.png') }}" alt="Overlay Top"
        class="overlay-top-img">

    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: rgba(31, 31, 31, 0.85);">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('cosmoFull-logo.png') }}" alt="Cosmo Logo">
                </a>

                <div class="ms-auto">
                    @if (Route::has('login'))
                        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-light text-dark" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="py-5">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
