<?php

namespace App\Listeners;

use App\Events\RejectJob;
use App\Mail\SendRejectianJobMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRejectioanEmailToCompany
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

        // Logic to send rejection email to the company
        $companyMail = $job->company->user->email;
        Mail::to($companyMail)->send(new SendRejectianJobMail($job));
    }
}
