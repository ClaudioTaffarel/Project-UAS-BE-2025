<!doctype html>
<head>
    <title>Cosmo</title>

    <!-- Import Bootstrap dan Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600&family=Miniver&family=Pacifico&display=swap" rel="stylesheet">

    <!-- css yg dipake: -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contentzz.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex">
        <div class="sidebar">
            <div>
                <div class="mb-4">
                    <img src="{{ asset('cosmoFull-logo2.png') }}" alt="Cosmo Logo" class="logo-img">
                </div>

                <ul class="nav flex-column mt-5">
                    <li class="nav-item mb-3">
                        <a class="sidebar-link" href="{{ route('home.index') }}">
                            <i class="fa fa-home me-2"></i> Home
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="sidebar-link" href="{{ route('recommendations.index') }}">
                            <i class="fa fa-compass me-2"></i> Recommendations
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="sidebar-link" href="{{ route('posts.create') }}">
                            <i class="fa fa-plus-square me-2"></i> New Post
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="sidebar-link" href="{{ route('messages.index') }}">
                            <i class="fa fa-envelope me-2"></i> Messages
                        </a>
                    </li>
                    @auth
                    <li class="nav-item mb-3">
                        <a class="sidebar-link" href="{{ route('profile.show', Auth::user()->id) }}">
                            <i class="fa fa-user me-2"></i> Profile
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <div>
                <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <main class="flex-fill p-4" style="margin-left: 260px;">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
