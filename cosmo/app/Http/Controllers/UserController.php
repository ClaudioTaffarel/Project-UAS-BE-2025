<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('username', 'like', "%{$query}%")
                    ->select('id', 'username', 'profile_picture') // pastikan kolom ini ada
                    ->limit(10)
                    ->get();

        return response()->json($users);
    }
}
