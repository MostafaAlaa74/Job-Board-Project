<?php

namespace App\Listeners;

use App\Events\ApplicationApplyed;
use App\Mail\SendApplicationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmailToApplicant
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
        $companyMail = $application->job->company->user->email;
        // Send The Email to the company
        Mail::to($companyMail)->send(new SendApplicationMail($application));
    }
}
