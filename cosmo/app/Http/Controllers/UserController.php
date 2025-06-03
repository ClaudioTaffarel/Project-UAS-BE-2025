<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post; // Import jika mau pakai postingan

class UserController extends Controller
{
            public function search(Request $request)
        {
            $query = $request->input('query');

            // Ambil semua user (untuk ditampilkan di view)
            $users = User::select('id', 'name', 'username', 'profile_image')->get();

            // Ambil post yang cocok dengan user yang dicari
            $posts = Post::query();

            if ($query) {
                $posts = $posts->whereHas('user', function ($q) use ($query) {
                    $q->where('username', 'like', "%{$query}%")
                    ->orWhere('name', 'like', "%{$query}%");
                });
            }

            return view('recommendations.recommends', [
                'users' => $users,
                'posts' => $posts->get()
            ]);
        }
}
