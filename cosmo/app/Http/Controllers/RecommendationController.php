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

            $posts = Post::where('user_id', '!=', $user->id)
                 ->with('user')
                 ->inRandomOrder()
                 ->take(20)
                 ->get();
        
        $users = User::select('id', 'username', 'name')->limit(500)->get();

        return view('recommendations.recommends', compact('posts', 'users'));
    }
}
