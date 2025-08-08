<?php

namespace App\Listeners;

use App\Events\RejectJob;
use App\Notifications\JobRejectedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRejectJocNotification
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
    public function handle(RejectJob $event): void
    {
        $job = $event->job;

        // Notify the user who applied for the job
        $job->company->user->notify(new JobRejectedNotification($job));
    }
}
