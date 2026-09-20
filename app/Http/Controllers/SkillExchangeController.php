<?php

namespace App\Http\Controllers;

use App\Models\SkillExchange;
use App\Models\User;
use App\Services\SkillExchangeService;
use Illuminate\Http\Request;

class SkillExchangeController extends Controller
{
    public function index(SkillExchangeService $exchangeService)
    {
        $user = auth()->user();

        $potentialExchanges = $exchangeService
            ->findPotentialExchanges($user);

        $proposedExchanges = $user
            ->skillExchangesProposed()
            ->with([
                'receiver',
                'teachSkill',
                'learnSkill',
            ])
            ->latest()
            ->get();

        $receivedExchanges = $user
            ->skillExchangesReceived()
            ->with([
                'proposer',
                'teachSkill',
                'learnSkill',
            ])
            ->latest()
            ->get();

        return view('skill-exchanges.index', compact(
            'potentialExchanges',
            'proposedExchanges',
            'receivedExchanges'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'teach_skill_id' => ['required', 'exists:skills,id'],
            'learn_skill_id' => ['required', 'exists:skills,id'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        abort_if(
            $validated['receiver_id'] === auth()->id(),
            403
        );

        SkillExchange::create([
            'proposer_id' => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'teach_skill_id' => $validated['teach_skill_id'],
            'learn_skill_id' => $validated['learn_skill_id'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('skill-exchanges.index')
            ->with('success', 'Skill exchange proposal sent successfully.');
    }

    public function accept(SkillExchange $skillExchange)
    {
        abort_unless(
            $skillExchange->receiver_id === auth()->id(),
            403
        );

        abort_unless(
            $skillExchange->status === 'pending',
            403
        );

        $skillExchange->update([
            'status' => 'accepted',
        ]);

        return back()->with(
            'success',
            'Skill exchange accepted successfully.'
        );
    }

    public function decline(SkillExchange $skillExchange)
    {
        abort_unless(
            $skillExchange->receiver_id === auth()->id(),
            403
        );

        abort_unless(
            $skillExchange->status === 'pending',
            403
        );

        $skillExchange->update([
            'status' => 'declined',
        ]);

        return back()->with(
            'success',
            'Skill exchange declined.'
        );
    }
}