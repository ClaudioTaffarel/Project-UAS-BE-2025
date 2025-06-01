<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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

        return view('recommendations.recommends', compact('posts'));
    }
}
