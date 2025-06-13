<?php

// app/Http/Controllers/FollowController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        Auth::user()->following()->attach($user->id);
        return back()->with('success', 'You are now following ' . $user->username);
    }

    public function destroy(User $user)
    {
        Auth::user()->following()->detach($user->id);
        return back();
    }

    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }
}

