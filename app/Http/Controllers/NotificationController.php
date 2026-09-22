<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display the user's notifications.
     */
    public function index(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark one notification as read.
     */
    public function read(Request $request, string $notification)
    {
        $user = $request->user();

        $user->notifications()
            ->where('id', $notification)
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }

    /**
     * Mark all notifications as read.
     */
    public function readAll(Request $request)
    {
        $request->user()
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }
}