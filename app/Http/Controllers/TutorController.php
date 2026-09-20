<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    /**
     * Display tutors and allow filtering by skill and location.
     */
   public function index(Request $request)
{
    $skillId = $request->input('skill_id');
    $location = $request->input('location');

    $tutors = User::whereHas('userSkills', function ($query) use ($skillId) {
        $query->where('type', 'teach');

        if ($skillId) {
            $query->where('skill_id', $skillId);
        }
    })
    ->with([
        'userSkills' => function ($query) {
            $query->where('type', 'teach')
                ->with('skill');
        },
        'reviewsReceived.reviewer',
        'availabilities',
    ])
    ->when($location, function ($query) use ($location) {
        $query->where('location', 'like', '%' . $location . '%');
    })
    ->orderBy('name')
    ->get();

    // Calculate rating information for each tutor
    $tutors->each(function ($tutor) {
        $tutor->average_rating = $tutor->reviewsReceived->avg('rating') ?? 0;
        $tutor->reviews_count = $tutor->reviewsReceived->count();
    });

    $skills = Skill::orderBy('name')->get();

    return view('tutors.index', compact(
        'tutors',
        'skills',
        'skillId',
        'location'
    ));
}

   public function show(User $tutor)
{
    $tutor->load([
        'userSkills' => function ($query) {
            $query->where('type', 'teach')
                ->with('skill');
        },
        'reviewsReceived.reviewer',
        'availabilities',
    ]);

    $averageRating = $tutor->reviewsReceived->avg('rating');

    return view('tutors.show', compact(
        'tutor',
        'averageRating'
    ));
}
}
