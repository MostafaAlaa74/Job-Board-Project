<?php

namespace App\Listeners;

use App\Events\ApplicationApplyed;
use App\Notifications\ApplicationApplyedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToCompany
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
        $application = $event->application;

        $application->user->notify( new ApplicationApplyedNotification($application) );
    }
}
