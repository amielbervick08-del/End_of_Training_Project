<?php

namespace App\Http\Controllers;

use App\Services\SkillPointService;
use App\Models\Booking;
use App\Models\RequestOffer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $bookings = Booking::with([
        'request.skill',
        'student',
        'tutor',
        'reviews',
    ])
    ->where(function ($query) use ($user) {
        $query->where('student_id', $user->id)
              ->orWhere('tutor_id', $user->id);
    })
    ->orderBy('date')
    ->orderBy('start_time')
    ->get();

    return view('bookings.index', compact('bookings'));
}
    /**
     * Show the booking form for an accepted offer.
     */
    public function create(RequestOffer $requestOffer)
    {
        $learningRequest = $requestOffer->request;

        // Only the owner of the learning request can create the booking.
        abort_unless(
            $learningRequest->user_id === auth()->id(),
            403
        );

        // Only accepted offers can be turned into bookings.
        abort_unless(
            $requestOffer->status === 'accepted',
            403
        );

        return view('bookings.create', compact(
            'requestOffer',
            'learningRequest'
        ));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request, RequestOffer $requestOffer)
    {
        $learningRequest = $requestOffer->request;

        // Only the owner of the learning request can create the booking.
        abort_unless(
            $learningRequest->user_id === auth()->id(),
            403
        );
 
        // Only accepted offers can be booked.
        abort_unless(
            $requestOffer->status === 'accepted',
            403
        );

        $validated = $request->validate([
    'date' => ['required', 'date'],
    'start_time' => ['required', 'date_format:H:i'],
    'end_time' => ['required', 'date_format:H:i'],
    'session_type' => ['required', 'in:online,in_person'],
]);

if ($validated['end_time'] <= $validated['start_time']) {
    return back()
        ->withErrors([
            'end_time' => 'The end time must be later than the start time.',
        ])
        ->withInput();
}
        // Make sure the selected session type is allowed by the request.
        if (
            $learningRequest->session_type !== 'either' &&
            $validated['session_type'] !== $learningRequest->session_type
        ) {
            return back()
                ->withErrors([
                    'session_type' => 'This session type is not allowed for this learning request.',
                ])
                ->withInput();
        }

        // Prevent duplicate bookings for the same request.
        $alreadyBooked = Booking::where('request_id', $learningRequest->id)
            ->whereIn('status', [
                'pending',
                'accepted',
                'confirmed',
            ])
            ->exists();

        if ($alreadyBooked) {
            return back()
                ->with('error', 'This learning request already has an active booking.');
        }

        Booking::create([
            'request_id' => $learningRequest->id,
            'student_id' => $learningRequest->user_id,
            'tutor_id' => $requestOffer->tutor_id,
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'session_type' => $validated['session_type'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('requests.show', $learningRequest)
            ->with('success', 'Booking created successfully. It is now pending confirmation.');
    }
    /**
 * Accept a pending booking.
 */
public function accept(Booking $booking)
{
    // Only the tutor assigned to this booking can accept it.
    abort_unless(
        $booking->tutor_id === auth()->id(),
        403
    );

    // Only pending bookings can be accepted.
    abort_unless(
        $booking->status === 'pending',
        403
    );

    $booking->update([
        'status' => 'accepted',
    ]);

    return back()->with(
        'success',
        'Booking accepted successfully.'
    );
}

public function confirm(Booking $booking)
{
    // Only the tutor can confirm an accepted booking.
    abort_unless(
        $booking->tutor_id === auth()->id(),
        403
    );

    // Only accepted bookings can be confirmed.
    abort_unless(
        $booking->status === 'accepted',
        403
    );

    $booking->update([
        'status' => 'confirmed',
    ]);

    return back()->with(
        'success',
        'Booking confirmed successfully.'
    );
}
public function complete(
    Booking $booking,
    SkillPointService $skillPointService
) {
    abort_unless(
        $booking->student_id === auth()->id()
        || $booking->tutor_id === auth()->id(),
        403
    );

    abort_unless($booking->status === 'confirmed', 403);

    $booking->update([
        'status' => 'completed',
    ]);

    $skillPointService->applyForCompletedBooking($booking->fresh());

    return back()->with(
        'success',
        'Booking completed successfully. SkillPoints have been updated.'
    );
}
}