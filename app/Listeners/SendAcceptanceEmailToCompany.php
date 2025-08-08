<?php

namespace App\Listeners;

use App\Events\AcceptJob;
use App\Mail\SendAcceptanceJobMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SendAcceptanceEmailToCompany
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
    public function handle(AcceptJob $event): void
    {
        $job = $event->job;

        // Check if the user has permission to accept the job

        // Logic to send acceptance email to the company
        $companyMail = $event->job->company->user->email;
        Mail::to($companyMail)->send(new SendAcceptanceJobMail($job));
        // This could involve using a notification or mail class

    }
}
