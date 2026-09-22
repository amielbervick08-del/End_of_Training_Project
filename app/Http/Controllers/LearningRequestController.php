<?php

namespace App\Http\Controllers;

use App\Models\LearningRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class LearningRequestController extends Controller
{
    /**
     * Display the user's learning requests.
     */
    public function index()
    {
        $requests = auth()->user()
            ->learningRequests()
            ->with('skill')
            ->latest()
            ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a learning request.
     */
    public function create()
    {
        $skills = Skill::orderBy('name')->get();

        return view('requests.create', compact('skills'));
    }

    /**
     * Store a new learning request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'location' => ['required', 'string', 'max:255'],
            'session_type' => ['required', 'in:online,in_person,either'],
            'duration' => ['required', 'integer', 'min:15', 'max:480'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'date_format:H:i'],
        ]);

        $request->user()->learningRequests()->create([
            ...$validated,
            'status' => 'open',
        ]);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Learning request posted successfully.');
    }

    /**
     * Display a specific learning request.
     */
    public function show(LearningRequest $learningRequest)
    {
        abort_unless(
            $learningRequest->user_id === auth()->id()
                || $learningRequest->status === 'open',
            403
        );

        $learningRequest->load([
            'skill',
            'user',
            'offers.tutor',
            'bookings.student',
            'bookings.tutor',
        ]);

        $existingOffer = $learningRequest->offers
            ->where('tutor_id', auth()->id())
            ->first();

        $matchingService = new \App\Services\TutorMatchingService();

        $matchingTutors = \App\Models\User::where('id', '!=', $learningRequest->user_id)
            ->whereHas('userSkills', function ($query) use ($learningRequest) {
                $query->where('skill_id', $learningRequest->skill_id)
                    ->where('type', 'teach');
            })
            ->with([
                'userSkills' => function ($query) {
                    $query->where('type', 'teach')
                        ->with('skill');
                },
                'reviewsReceived',
                'availabilities',
            ])
            ->get()
            ->map(function ($tutor) use ($learningRequest, $matchingService) {
                $tutor->match_score = $matchingService->calculateMatchScore(
                    $learningRequest,
                    $tutor
                );

                return $tutor;
            })
            ->sortByDesc('match_score')
            ->values();

        return view('requests.show', compact(
            'learningRequest',
            'existingOffer',
            'matchingTutors'
        ));
    }
    /**
     * Show the form for editing a learning request.
     */
    public function edit(LearningRequest $learningRequest)
    {
        abort_unless(
            $learningRequest->user_id === auth()->id(),
            403
        );

        $skills = Skill::orderBy('name')->get();

        return view('requests.edit', compact('learningRequest', 'skills'));
    }

    /**
     * Update a learning request.
     */
    public function update(Request $request, LearningRequest $learningRequest)
    {
        abort_unless(
            $learningRequest->user_id === auth()->id(),
            403
        );

        $validated = $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'location' => ['required', 'string', 'max:255'],
            'session_type' => ['required', 'in:online,in_person,either'],
            'duration' => ['required', 'integer', 'min:15', 'max:480'],
            'preferred_date' => ['nullable', 'date'],
            'preferred_time' => ['nullable', 'date_format:H:i'],
        ]);

        $learningRequest->update($validated);

        return redirect()
            ->route('requests.show', $learningRequest)
            ->with('success', 'Learning request updated successfully.');
    }
    /**
     * Cancel a learning request.
     */
    public function cancel(LearningRequest $learningRequest)
    {
        abort_unless(
            $learningRequest->user_id === auth()->id() ||
                $learningRequest->status === 'open',
            403
        );

        $learningRequest->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('requests.show', $learningRequest)
            ->with('success', 'Learning request cancelled successfully.');
    }
    /**
     * Display open learning requests for tutors.
     */
    public function browse(Request $request)
    {
        $skillId = $request->input('skill_id');
        $location = $request->input('location');

        $requests = LearningRequest::where('status', 'open')
            ->with(['user', 'skill'])
            ->when($skillId, function ($query) use ($skillId) {
                $query->where('skill_id', $skillId);
            })
            ->when($location, function ($query) use ($location) {
                $query->where('location', 'like', '%' . $location . '%');
            })
            ->latest()
            ->get();

        $skills = Skill::orderBy('name')->get();

        return view('requests.browse', compact(
            'requests',
            'skills',
            'skillId',
            'location'
        ));
    }
}
