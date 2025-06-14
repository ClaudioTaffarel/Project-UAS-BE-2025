<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image_path' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show($id)
    {
        $post = Post::with(['user', 'likes', 'comments.user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Bukan Akunmu Brodii');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Bukan Akunmu Brodii');
        }

        $data = $request->validate([
            'caption' => 'required',
        ]);

        $post->update($data);

        return redirect('/posts/' . $post->id);
    }

    public function destroy(Post $post)
    {
        $currentUser = auth()->user();

        // Izinkan hapus jika pemilik post ATAU username-nya adalah edbert19 (admin)
        if ($currentUser->id !== $post->user_id && $currentUser->username !== 'edbert19') {
            abort(403, 'Lu bukan pemilik post, dan bukan admin juga');
        }

        Storage::disk('public')->delete($post->image_path);

        $post->delete();

        return redirect()->back()->with('success', 'Post berhasil dihapus');
    }


}

