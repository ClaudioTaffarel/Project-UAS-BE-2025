<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cosmo') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark d-flex flex-column justify-content-between p-4 position-fixed" style="width: 260px; height: 100vh;">
            <div>
                <div class="mb-4">
                    <img src="{{ asset('cosmoFull-logo2.png') }}" alt="Cosmo Logo" class="logo-img">
                </div>

                <ul class="nav flex-column mt-5">
                    <li class="nav-item mb-3">
                        <a class="btn btn-outline-light nav-link fs-5 text-start w-100 d-flex align-items-center"
                            style = "white-space: nowrap;" href="{{ route('home.index') }}">
                            <i class="fa fa-home me-2"></i> Home
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="btn btn-outline-light nav-link fs-5 text-start w-100 d-flex align-items-center"
                            style = "white-space: nowrap;" href="{{ route('recommendations.index') }}">
                            <i class="fa fa-compass me-2"></i> Recommendations
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="btn btn-outline-light nav-link fs-5 text-start w-100" href="{{ route('posts.create') }}">
                            <i class="fa fa-plus-square me-2"></i> New Post
                        </a>
                    </li>
                    @auth
                    <li class="nav-item mb-3">
                        <a class="btn btn-outline-light nav-link fs-5 text-start w-100" href="{{ route('profile.show', Auth::user()->id) }}">
                            <i class="fa fa-user me-2"></i> Profile
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item mb-3">
                        <a class="btn btn-outline-light nav-link fs-5 text-start w-100 d-flex align-items-center"
                            style="white-space: nowrap;" href="{{ route('messages.index') }}">
                            <i class="fa fa-envelope me-2"></i> Messages
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Logout di paling bawah -->
            <div>
                <a class="btn btn-outline-light nav-link fs-5 text-start w-100" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-fill p-4" style="margin-left: 260px;">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>