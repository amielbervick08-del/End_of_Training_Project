<?php

namespace App\Services;

use App\Models\LearningRequest;
use App\Models\User;

class TutorMatchingService
{
    /**
     * Calculate a tutor's match score for a learning request.
     */
    public function calculateMatchScore(
        LearningRequest $learningRequest,
        User $tutor
    ): int {
        $score = 0;

        /*
         * 1. Skill match: +40
         *
         * The tutor must teach the skill requested by the learner.
         */
        $teachesRequestedSkill = $tutor->userSkills()
            ->where('skill_id', $learningRequest->skill_id)
            ->where('type', 'teach')
            ->exists();

        if ($teachesRequestedSkill) {
            $score += 40;
        }

        /*
         * 2. Location: up to +25
         *
         * Exact location match gets 25 points.
         * Partial location match gets 15 points.
         */
        if ($tutor->location && $learningRequest->location) {

            $tutorLocation = strtolower(trim($tutor->location));
            $requestLocation = strtolower(trim($learningRequest->location));

            if ($tutorLocation === $requestLocation) {
                $score += 25;
            } elseif (
                str_contains($tutorLocation, $requestLocation) ||
                str_contains($requestLocation, $tutorLocation)
            ) {
                $score += 15;
            }
        }

        /*
         * 3. Rating: up to +15
         */
        $averageRating = $tutor->reviewsReceived()->avg('rating');

        if ($averageRating) {
            $score += (int) round(($averageRating / 5) * 15);
        }

        /*
         * 4. Availability: up to +15
         *
         * For now, we check whether the tutor has availability
         * on the requested date.
         */
        if ($learningRequest->preferred_date) {

            $dayOfWeek = $learningRequest->preferred_date->dayOfWeek;

            $hasAvailability = $tutor->availabilities()
                ->where('day_of_week', $dayOfWeek)
                ->exists();

            if ($hasAvailability) {
                $score += 15;
            }
        } elseif ($tutor->availabilities()->exists()) {

            // The learner has not specified a date,
            // but the tutor has availability.
            $score += 15;
        }

        return min($score, 100);
    }
}
