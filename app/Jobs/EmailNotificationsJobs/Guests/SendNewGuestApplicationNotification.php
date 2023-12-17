<?php

namespace App\Jobs\EmailNotificationsJobs\Guests;

use App\Mail\Notifications\Guests\NewGuestApplicationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewGuestApplicationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $guestApplicationData;
    public function __construct(array $guestApplicationData)
    {
        $this->guestApplicationData = $guestApplicationData;
    }

    public function handle(): void
    {
        Mail::to('security@example.com')->send(new NewGuestApplicationNotification($this->guestApplicationData));
    }
}
