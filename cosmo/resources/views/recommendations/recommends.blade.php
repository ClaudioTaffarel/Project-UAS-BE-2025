@extends('layouts.app')

@section('content')

<form method="GET" action="{{ route('users.search') }}" class="mb-4" style="max-width: 500px; position: relative;">
    <input
        type="text"
        id="search-input"
        name="query"
        class="form-control"
        placeholder="Search for other Astrounouts.."
        autocomplete="off"
        style="background-color: #808080 !important;"
    >
    <div id="suggestions" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ccc; z-index: 1000; display: none; max-height: 150px; overflow-y: auto;"></div>
</form>

<script>
    const users = @json($users);
    const searchInput = document.getElementById('search-input');
    const suggestionsBox = document.getElementById('suggestions');

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();

        if (query.length === 0) {
            suggestionsBox.style.display = 'none';
            suggestionsBox.innerHTML = '';
            return;
        }

        const filtered = users.filter(user => 
            user.username.toLowerCase().includes(query) || user.name.toLowerCase().includes(query)
<<<<<<< HEAD
        ).slice(0, 5); // Batasi max 5 hasil
=======
        ).slice(0, 5);
>>>>>>> 30f7f02 (Commit 5 Devin : Optimisasi search dan Recommendation page)

        if (filtered.length === 0) {
            suggestionsBox.style.display = 'none';
            suggestionsBox.innerHTML = '';
            return;
        }

        suggestionsBox.innerHTML = filtered.map(user => `
<<<<<<< HEAD
            <div class="suggestion-item" style="padding: 8px; cursor: pointer;">
                <a href="/users/${user.id}" style="text-decoration: none; color: black;">
                    <strong>${user.username}</strong> - ${user.name}
=======
            <div class="suggestion-item" style="padding: 8px; cursor: pointer; display: flex; align-items: center;">
                <img src="${user.profile_image_url}" alt="${user.username}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                <a href="/profile/${user.id}" style="text-decoration: none; color: black;">
                    <div>
                        <strong>${user.username}</strong><br>
                        <small>${user.name}</small>
                    </div>
>>>>>>> 30f7f02 (Commit 5 Devin : Optimisasi search dan Recommendation page)
                </a>
            </div>
        `).join('');
        suggestionsBox.style.display = 'block';
    });

    document.addEventListener('click', function(e) {
        if (!suggestionsBox.contains(e.target) && e.target !== searchInput) {
            suggestionsBox.style.display = 'none';
        }
    });
</script>


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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($posts as $post)
                <div class="col">
                    <a href="{{ route('posts.show', $post->id) }}">
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 10px;">
                            <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://via.placeholder.com/250' }}"
                                alt="Post Image"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
@endsection
