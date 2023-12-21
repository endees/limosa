<?php

namespace App\Listeners;

use App\Mail\JobFailed as JobFailedEmail;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Mail;

class SendJobFailedNotification
{
    /**
     * Handle the event.
     */
    public function handle(JobFailed $event): void
    {
        $jobFailedMail = new JobFailedEmail($event->exception, $event->job->getJobId());
        Mail::to(config('limosa.admin_recipients'))->send($jobFailedMail);
    }
}
