<?php

namespace App\Listeners;

use App\Events\ApplicationApplyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApplyingNotify
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicationApplyed $event): void
    {
        // Here we can access the application that was applied
        $application = $event->application;

        // Notify the user about the application
        $application->user->notify(new \App\Notifications\ApplingToJobNotification($application));

        // Optionally, you can log or perform other actions here
        // Log::info('Application applied for job: ' . $application->job->title);
    }
}
