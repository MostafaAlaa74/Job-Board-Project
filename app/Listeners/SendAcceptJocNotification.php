<?php

namespace App\Listeners;

use App\Events\AcceptJob;
use App\Notifications\JobAcceptedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\InteractsWithQueue;

class SendAcceptJocNotification
{
    use InteractsWithQueue , Notifiable;
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
    public function handle(AcceptJob $event): void
    {
        $job = $event->job;

        $user = $job->user;

        // Notify the user who applied for the job
        $job->company->user->notify(new JobAcceptedNotification($job));

        // $job->company->user->notify(new JobAcceptedNotification($job));

    }
}
