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
                 ->when($query, function($q) use ($query) {
                    $q->where('username', 'like', "%{$query}%")
                      ->orWhere('name', 'like', "%{$query}%");
                 })
                 ->limit(20)
                 ->get();

    return view('recommendations.recommends', compact('users'));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
