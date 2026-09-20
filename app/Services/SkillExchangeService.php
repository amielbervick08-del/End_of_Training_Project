<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class SkillExchangeService
{
    /**
     * Find potential skill exchanges for a user.
     */
    public function findPotentialExchanges(User $user): Collection
    {
        $userTeachSkillIds = $user->userSkills()
            ->where('type', 'teach')
            ->pluck('skill_id');

        $userLearnSkillIds = $user->userSkills()
            ->where('type', 'learn')
            ->pluck('skill_id');

        if ($userTeachSkillIds->isEmpty() || $userLearnSkillIds->isEmpty()) {
            return collect();
        }

        $potentialUsers = User::where('id', '!=', $user->id)
            ->whereHas('userSkills', function ($query) use ($userTeachSkillIds) {
                $query->where('type', 'learn')
                    ->whereIn('skill_id', $userTeachSkillIds);
            })
            ->whereHas('userSkills', function ($query) use ($userLearnSkillIds) {
                $query->where('type', 'teach')
                    ->whereIn('skill_id', $userLearnSkillIds);
            })
            ->with([
                'userSkills' => function ($query) {
                    $query->with('skill');
                },
            ])
            ->get();

        return $potentialUsers->map(function ($potentialUser) use (
            $userTeachSkillIds,
            $userLearnSkillIds
        ) {
            $skillsTheyWantToLearn = $potentialUser->userSkills
                ->where('type', 'learn')
                ->whereIn('skill_id', $userTeachSkillIds);

            $skillsTheyCanTeach = $potentialUser->userSkills
                ->where('type', 'teach')
                ->whereIn('skill_id', $userLearnSkillIds);

            return [
                'user' => $potentialUser,
                'skills_you_can_teach' => $skillsTheyWantToLearn,
                'skills_they_can_teach' => $skillsTheyCanTeach,
            ];
        });
    }
}
