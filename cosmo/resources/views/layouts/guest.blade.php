<!doctype html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>cosmo</title>

    <!-- Import Bootstrap dan Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600&family=Miniver&family=Pacifico&display=swap" rel="stylesheet">

    <!-- css yg dipake: -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>
<body>
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('spacevid2.mp4') }}" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <img src="{{ asset('doodles.png') }}" alt="Overlay Top" class="overlay-top-img">

    <div id="app">
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

        <main class="py-5">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
