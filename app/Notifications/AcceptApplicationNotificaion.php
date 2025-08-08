<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptApplicationNotificaion extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Job Application Has Been Accepted')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Congratulations! Your application for the job "' . $this->application->job->title . '" at ' . $this->application->job->company->name . ' has been accepted.')
            ->line('We will contact you soon with further details.')
            ->action('View Job', url('/jobs/' . $this->application->job->id))
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
            'application_id' => $this->application->id,
            'job_title' => $this->application->job->title,
            'company_name' => $this->application->job->company->name,
            'message' => 'Your application for the job "' . $this->application->job->title . '" has been accepted.',
            'status' => 'accepted',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'job_title' => $this->application->job->title,
            'company_name' => $this->application->job->company->name,
            'message' => 'Your application for the job "' . $this->application->job->title . '" has been accepted.',
            'status' => 'accepted',
        ];
    }
}
