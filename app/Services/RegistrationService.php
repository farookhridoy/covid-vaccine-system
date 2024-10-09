<?php

namespace App\Services;

use App\Models\User;
use DateTime;

class RegistrationService
{
    /**
     * @param $center
     * @return string
     */

    public static function GetScheduledDate($center): string
    {
        // Get the last scheduled date for the center
        $lastDate = User::where('vaccine_center_id', $center->id)
            ->whereNotNull('scheduled_date')
            ->orderBy('scheduled_date', 'desc')
            ->first();

        // Find last schedule date, otherwise use the today as current date
        $nextDate = $lastDate ? new DateTime($lastDate->scheduled_date) : new DateTime();

        // Add 1 day to the last scheduled date if it's not the first registration
        if ($lastDate) {
            $nextDate->modify('+1 day');
        }

        // Ensure it's a weekday (Sunday to Thursday)
        while (in_array($nextDate->format('N'), [5, 6])) {  // 5 = Friday, 6 = Saturday
            $nextDate->modify('+1 day');
        }

        // Check if the center's capacity for that day is full
        $scheduledCount = User::where('vaccine_center_id', $center->id)
            ->where('scheduled_date', $nextDate->format('Y-m-d'))
            ->count();

        // If the capacity is full for the current day, move to the next available day
        if ($scheduledCount >= $center->capacity) {
            $nextDate->modify('+1 day');

            // Ensure it's a weekday (skip weekends)
            while (in_array($nextDate->format('N'), [5, 6])) {
                $nextDate->modify('+1 day');
            }

            // Recursively call the function to check capacity for the next available date
            return self::GetScheduledDate($center);
        }

        // Return the next available date in Y-m-d format
        return $nextDate->format('Y-m-d');
    }
}
