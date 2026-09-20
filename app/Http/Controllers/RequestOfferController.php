<?php

namespace App\Http\Controllers;

use App\Models\LearningRequest;
use App\Models\RequestOffer;
use Illuminate\Http\Request;

class RequestOfferController extends Controller
{
    /**
     * Store a tutor's offer to help with a learning request.
     */
    public function store(Request $request, LearningRequest $learningRequest)
    {
        // Only open requests can receive offers.
        abort_unless($learningRequest->status === 'open', 403);

        // The person who created the request cannot offer to help themselves.
        abort_if($learningRequest->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        // Prevent the same tutor from offering twice.
        $alreadyExists = RequestOffer::where('request_id', $learningRequest->id)
            ->where('tutor_id', auth()->id())
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'You have already offered to help with this request.');
        }

        RequestOffer::create([
            'request_id' => $learningRequest->id,
            'tutor_id' => auth()->id(),
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your offer to help has been sent.');
    }
    /**
 * Accept an offer to help.
 */
public function accept(RequestOffer $requestOffer)
{
    $learningRequest = $requestOffer->request;

    // Only the owner of the request can accept an offer.
    abort_unless(
        $learningRequest->user_id === auth()->id(),
        403
    );

    // Only pending offers can be accepted.
    abort_unless(
        $requestOffer->status === 'pending',
        403
    );

    // Accept the offer.
    $requestOffer->update([
        'status' => 'accepted',
    ]);

    // Create a pending booking for the accepted tutor.
    \App\Models\Booking::create([
        'request_id' => $learningRequest->id,
        'student_id' => $learningRequest->user_id,
        'tutor_id' => $requestOffer->tutor_id,
        'date' => $learningRequest->preferred_date,
        'start_time' => $learningRequest->preferred_time,
        'end_time' => \Carbon\Carbon::parse($learningRequest->preferred_time)
            ->addMinutes($learningRequest->duration)
            ->format('H:i:s'),
        'session_type' => $learningRequest->session_type,
        'status' => 'pending',
    ]);

    return back()->with(
        'success',
        'Offer accepted and booking created successfully.'
    );
}
/**
 * Decline an offer to help.
 */
public function decline(RequestOffer $requestOffer)
{
    $learningRequest = $requestOffer->request;

    // Only the owner of the request can decline an offer.
    abort_unless(
        $learningRequest->user_id === auth()->id(),
        403
    );

    // Only pending offers can be declined.
    abort_unless(
        $requestOffer->status === 'pending',
        403
    );

    $requestOffer->update([
        'status' => 'declined',
    ]);

    return back()->with(
        'success',
        'Offer declined.'
    );
}
}
