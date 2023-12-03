<?php

namespace App\Jobs;

use App\Mail\ApplicationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewApplicationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guestApplicationData;
    public function __construct(array $guestApplicationData)
    {
        $this->guestApplicationData = $guestApplicationData;
    }

    public function handle(): void
    {
        Mail::to('security@example.com')->send(new ApplicationNotification($this->guestApplicationData));
    }
}
