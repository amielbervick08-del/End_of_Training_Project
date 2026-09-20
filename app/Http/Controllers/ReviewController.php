<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the review form for a completed booking.
     */
    public function create(Booking $booking)
    {
        abort_unless($booking->status === 'completed', 403);

        abort_unless(
            $booking->student_id === auth()->id() ||
            $booking->tutor_id === auth()->id(),
            403
        );

        $alreadyReviewed = Review::where('booking_id', $booking->id)
            ->where('reviewer_id', auth()->id())
            ->exists();

        abort_if($alreadyReviewed, 403);

        $revieweeId = $booking->student_id === auth()->id()
            ? $booking->tutor_id
            : $booking->student_id;

        $reviewee = \App\Models\User::findOrFail($revieweeId);

       $booking->load('request');

return view('reviews.create', compact('booking', 'reviewee'));
    }

    /**
     * Store a review.
     */
    public function store(Request $request, Booking $booking)
    {
        abort_unless($booking->status === 'completed', 403);

        abort_unless(
            $booking->student_id === auth()->id() ||
            $booking->tutor_id === auth()->id(),
            403
        );

        $alreadyReviewed = Review::where('booking_id', $booking->id)
            ->where('reviewer_id', auth()->id())
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this booking.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        $revieweeId = $booking->student_id === auth()->id()
            ? $booking->tutor_id
            : $booking->student_id;

        Review::create([
            'booking_id' => $booking->id,
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $revieweeId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()
            ->route('requests.show', $booking->request_id)
            ->with('success', 'Review submitted successfully.');
    }
}