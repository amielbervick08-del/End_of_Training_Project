<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display the user's conversations.
     */
   public function index()
{
    $user = auth()->user();

    $messages = Message::with(['sender', 'receiver'])
        ->where('sender_id', $user->id)
        ->orWhere('receiver_id', $user->id)
        ->latest()
        ->get();

    $unreadCount = Message::where('receiver_id', $user->id)
        ->where('is_read', false)
        ->count();

    return view('messages.index', compact(
        'messages',
        'unreadCount'
    ));
}
    /**
     * Display a conversation with another user.
     */
    public function show(User $user)
    {
        abort_if($user->id === auth()->id(), 403);

        $messages = Message::with(['sender', 'receiver'])
            ->where(function ($query) use ($user) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', auth()->id());
            })
            ->oldest()
            ->get();

        Message::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.show', compact('user', 'messages'));
    }

    /**
     * Send a message to another user.
     */
    public function store(Request $request, User $user)
    {
        abort_if($user->id === auth()->id(), 403);

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('messages.show', $user)
            ->with('success', 'Message sent successfully.');
    }
}