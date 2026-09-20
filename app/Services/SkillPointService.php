<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class SkillPointService
{
    /**
     * Apply SkillPoints for a completed booking.
     *
     * Teaching earns +1 point per hour.
     * Learning costs -1 point per hour.
     */
    public function applyForCompletedBooking(Booking $booking): void
    {
        // Prevent the same booking from awarding points twice.
        if ($booking->skill_points_awarded) {
            return;
        }

        $durationInHours = $this->calculateDurationInHours($booking);

        DB::transaction(function () use ($booking, $durationInHours) {
            // Tutor earns SkillPoints.
            $booking->tutor->increment(
                'skill_points',
                $durationInHours
            );

            // Student spends SkillPoints.
            $booking->student->decrement(
                'skill_points',
                $durationInHours
            );

            // Mark this booking as processed.
            $booking->update([
                'skill_points_awarded' => true,
            ]);
        });
    }

    /**
     * Calculate booking duration in whole hours.
     */
    private function calculateDurationInHours(Booking $booking): int
    {
        $start = strtotime($booking->start_time);
        $end = strtotime($booking->end_time);

        $minutes = ($end - $start) / 60;

        return max(1, (int) round($minutes / 60));
    }
}