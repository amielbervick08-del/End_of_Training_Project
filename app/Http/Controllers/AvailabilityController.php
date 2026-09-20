<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    /**
     * Display the user's availability.
     */
    public function index()
    {
        $availabilities = auth()->user()
            ->availabilities()
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('availability.index', compact('availabilities'));
    }

    /**
     * Store a new availability slot.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
        ]);

        if ($validated['end_time'] <= $validated['start_time']) {
            return back()
                ->withErrors([
                    'end_time' => 'The end time must be later than the start time.',
                ])
                ->withInput();
        }

        $alreadyExists = auth()->user()
            ->availabilities()
            ->where('day_of_week', $validated['day_of_week'])
            ->where('start_time', $validated['start_time'])
            ->where('end_time', $validated['end_time'])
            ->exists();

        if ($alreadyExists) {
            return back()->with(
                'error',
                'This availability slot already exists.'
            );
        }

        auth()->user()->availabilities()->create($validated);

        return back()->with(
            'success',
            'Availability added successfully.'
        );
    }

    /**
     * Remove an availability slot.
     */
    public function destroy(Availability $availability)
    {
        abort_unless(
            $availability->user_id === auth()->id(),
            403
        );

        $availability->delete();

        return back()->with(
            'success',
            'Availability removed successfully.'
        );
    }
}
