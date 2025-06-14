<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $suggestions = User::where('id', '!=', auth()->id())
        ->whereDoesntHave('followers', function ($query) {
            $query->where('follower_id', auth()->id());
        })
        ->whereNotNull('profile_image') // pastikan ada isiAdd commentMore actions
        ->where('profile_image', '!=', 'user-placeholder.png')
        ->take(5)
        ->get();

        $followingIds = $user->following()->pluck('users.id')->toArray();

        $followingIds[] = $user->id;

        $posts = Post::whereIn('user_id', $followingIds)
        ->latest()
        ->paginate(10);

        return view('home', compact('posts', 'suggestions'));
    }
}