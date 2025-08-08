<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobAcceptedNotification extends Notification
{
    use Queueable;

    public $job;
    /**
     * Create a new notification instance.
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Job Has Been Accepted')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your Job ' . $this->job->title . 'Has Been Accepted')
            ->action('View More Details', url('/jobs/' . $this->job->id))
            ->line('Thank you for using our job portal!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'application_id' => $this->job->id,
            'job_title' => $this->job->title,
            'company_name' => $this->job->company->name,
            'message' => 'Your Job ' . $this->job->title . 'Has Been Accepted',
            'status' => 'accepted',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->job->id,
            'job_title' => $this->job->title,
            'company_name' => $this->job->company->name,
            'message' => 'Your Job ' . $this->job->title . 'Has Been Accepted',
            'status' => 'accepted',
        ];
    }
}
