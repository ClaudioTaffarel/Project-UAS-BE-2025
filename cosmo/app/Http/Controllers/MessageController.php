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
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.index', ['users' => $users]);
    }

    public function show($userId)
    {
        $users = User::where('id', '!=', Auth::id())->get();
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
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'body' => $request->body,
            ]);

            // Eager load sender information
            $message->load('sender');

            return response()->json(['message' => $message]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Message storing failed: ' . $e->getMessage());
            return response()->json(['error' => 'Server error, could not save message.'], 500);
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
        // Pastikan hanya pengirim yang bisa menghapus pesan
        if ($message->sender_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus pesan ini.');
        }

        $message->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
