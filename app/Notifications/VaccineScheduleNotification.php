<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccineScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vaccine Appointment Reminder From VRS')
            ->line('Dear ' . $this->user->name)
            ->line('This is a reminder that you have a scheduled vaccination appointment on:')
            ->line('Date: '.  $this->user->scheduled_date)
            ->line('Vaccine Center Name: '.  $this->user->vaccineCenter->name)
            ->line('Vaccine Center Address: '.  $this->user->vaccineCenter->address)
            ->line('Please ensure you arrive at the center on time. Thank you for taking the step to get vaccinated! ')
            ->line('Didn’t create an account? No worries – Feel free to ignore this email. ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
