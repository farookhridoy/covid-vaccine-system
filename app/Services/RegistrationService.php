<?php

namespace App\Services;

use App\Models\VaccineCenter;
use DateTime;

class RegistrationService
{
    /**
     * @param $center
     * @return array
     */

    public static function GetCenterWiseScheduledUsers(): array
    {
        // Get users scheduled for tomorrow's vaccination
        $tomorrow = (new DateTime())->modify('+1 day');
        while (in_array($tomorrow->format('N'), [5, 6])) {  // 5 = Friday, 6 = Saturday
            $tomorrow->modify('+1 day');
        }
        $tomorrow = $tomorrow->format('Y-m-d');

        $centers = VaccineCenter::with([
            'users' => function ($query) {
                return $query->where('status', 'not_scheduled');
            },
            'scheduledUsers' => function ($query) use ($tomorrow) {
                return $query->where('scheduled_date', $tomorrow);
            }
        ])
            ->whereHas('users', function ($query) {
                return $query->where('status', 'not_scheduled');
            })->get();

        return [
            'scheduleCenters' => $centers,
            'date' => $tomorrow
        ];
    }
}
