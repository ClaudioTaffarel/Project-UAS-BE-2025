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

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Yang bisa delete: pemilik post dan Admin (edbert19)
        if (auth()->id() !== $post->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($post->image_path && \Storage::exists($post->image_path)) {
            \Storage::delete($post->image_path);
        }

        $post->delete();

        $redirect = $request->input('redirect_from') === 'recommendation'
            ? route('recommendations.index')
            : route('home');

        return redirect($redirect)->with('status', 'Post deleted successfully.');
    }
}

