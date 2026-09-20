<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    /**
     * Display the user's skills.
     */
    public function index()
    {
        $user = auth()->user();

        $userSkills = $user->userSkills()
            ->with('skill')
            ->get();

        $skills = Skill::orderBy('name')->get();

        return view('skills.index', compact('userSkills', 'skills'));
    }

    /**
     * Add a skill to the user's profile.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
            'type' => ['required', 'in:teach,learn'],
            'level' => ['required', 'in:beginner,intermediate,advanced,expert'],
        ]);

        $user = auth()->user();

        $alreadyExists = $user->userSkills()
            ->where('skill_id', $validated['skill_id'])
            ->where('type', $validated['type'])
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'You already have this skill in your list.');
        }

        $user->userSkills()->create($validated);

        return back()->with('success', 'Skill added successfully.');
    }

    /**
     * Remove a skill from the user's profile.
     */
    public function destroy(UserSkill $userSkill)
    {
        if ($userSkill->user_id !== auth()->id()) {
            abort(403);
        }

        $userSkill->delete();

        return back()->with('success', 'Skill removed successfully.');
    }
}
