<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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

        $followingIds = $user->following()->pluck('users.id')->toArray();

        $followingIds[] = $user->id;

        $posts = Post::whereIn('user_id', $followingIds)
                     ->latest()
                     ->paginate(10);  // pagination 10 per halaman

        return view('home', compact('posts'));
    }
}
