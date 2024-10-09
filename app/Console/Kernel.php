<?php

namespace App\Console;

use App\Notifications\VaccineScheduleNotification;
use App\Services\RegistrationService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {

            //Get center wise schedules users data
            $centers = RegistrationService::GetCenterWiseScheduledUsers();

            foreach ($centers['scheduleCenters'] as $center) {
                $count = $center->scheduledUsers->count();
                foreach ($center->users as $user) {
                    if ($center->capacity > $count) {

                        $user->scheduled_date = $centers['date'];
                        $user->status = 'scheduled';
                        $user->save();

                        // Send email reminder
                        $user->notify(new VaccineScheduleNotification($user));

                        $count++;
                    }
                }
            }

        })->dailyAt('21:00'); // Schedule this to run every day at 9 PM

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
