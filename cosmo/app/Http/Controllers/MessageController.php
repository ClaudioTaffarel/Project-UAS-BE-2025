<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $users = Auth::user()->following;
        return view('messages.index', ['users' => $users]);
    }

    public function show($userId)
    {
        $users = Auth::user()->following;
        $receiver = User::findOrFail($userId);

        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('messages.index', [
            'users' => $users,
            'receiver' => $receiver,
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string|max:1000',
        ]);
        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'body' => $request->body,
            ]);
            return redirect()->route('messages.show', $request->receiver_id)->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Message storing failed: ' . $e->getMessage());
            return back()->with('error', 'Server error, could not save message.');
        }
    }

    public function fetch($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json(['messages' => $messages]);
    }

    public function destroy(Message $message)
    {
        if ($message->sender_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus pesan ini.');
        }

        $message->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
