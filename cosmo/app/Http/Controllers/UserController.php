<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
public function search(Request $request)
{
    $query = $request->input('query');

    $users = User::select('id', 'name', 'username', 'profile_image')
        ->when($query, function ($q) use ($query) {
            $q->where('username', 'like', "%{$query}%")
              ->orWhere('name', 'like', "%{$query}%");
        })
        ->limit(20)
        ->get()
        ->map(function ($user) {
            $user->profile_image_url = $user->profile_image
                ? asset('storage/' . $user->profile_image)
                : asset('default-profile.png');
            return $user;
        });

    $posts = Post::latest()->take(12)->get();

    return view('recommendations.recommends', compact('users', 'posts', 'query'));
}


}
