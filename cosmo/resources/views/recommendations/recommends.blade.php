@extends('layouts.app')

@section('content')
    <div class="mb-4 position-relative" style="max-width: 500px;">
        <input type="text" id="user-search" class="form-control" placeholder=" Search for other Astrounouts.." style="background-color: #808080 !important;">
        <ul class="list-group position-absolute w-100" id="search-results" style="z-index: 1000; display: none;"></ul>
    </div>

    <h1 class="mb-4 milkyway-title">Whats going on in the milky way style</h1>

    <style>
        .milkyway-title {
            color: rgb(119, 178, 218);
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .post-grid a {
            display: block;
            position: relative;
        }

        .post-grid img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .post-grid a:hover img {
            transform: scale(1.03);
        }
    </style>

    @if($posts->count())
        <div class="post-grid mb-5">
            @foreach($posts as $post)
                @if($post->image_url)
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ $post->image_url }}" alt="Post Image">
                    </a>
                @endif
            @endforeach
        </div>
    @else
        <p>No recommendations available right now.</p>
    @endif

    {{-- AJAX search script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#user-search').on('input', function () {
            const query = $(this).val();

            if (query.length < 2) {
                $('#search-results').hide();
                return;
            }

            $.ajax({
                url: '{{ route("users.search") }}',
                data: { query },
                success: function (users) {
                    const results = $('#search-results');
                    results.empty();

                    if (users.length > 0) {
                        users.forEach(user => {
                            results.append(`
                                <li class="list-group-item">
                                    <a href="/profile/${user.id}" class="d-flex align-items-center text-decoration-none text-dark">
                                        <img src="${user.profile_picture ?? '/default.png'}" width="30" height="30" class="rounded-circle me-2">
                                        ${user.username}
                                    </a>
                                </li>
                            `);
                        });
                        results.show();
                    } else {
                        results.hide();
                    }
                }
            });
        });
    </script>
@endsection
