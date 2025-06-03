<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $followingIds = $user->following()->pluck('users.id');

        $posts = Post::whereNotIn('user_id', $followingIds)
                     ->with('user')
                     ->inRandomOrder()
                     ->take(20)
                     ->get();

        // ⬇️ Tambahkan ini untuk ambil data user suggestion
        $users = User::select('id', 'username', 'name')->limit(500)->get();

        // ⬇️ Pastikan kedua variabel ini sudah ada sebelum compact
        return view('recommendations.recommends', compact('posts', 'users'));
    }
}

