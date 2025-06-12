<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
   public function index()
    {
        $suggestions = User::where('id', '!=', Auth::id())
                            ->whereDoesntHave('followers', function ($query) {
                                $query->where('follower_id', Auth::id());
                            })
                            ->orderByDesc('id') // urut berdasarkan ID dari besar ke kecil
                            ->take(100)
                            ->get();

        return view('suggestions.index', compact('suggestions'));
    }

}
