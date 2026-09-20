<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display all available skills.
     */
    public function index()
    {
        $skills = Skill::orderBy('category')
            ->orderBy('name')
            ->get();

        return view('skills.browse', compact('skills'));
    }
}