<?php

namespace App\Jobs\EmailNotificationsJobs\Guests;

use App\Mail\Notifications\Guests\AddNewGuestNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAddNewGuestNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $newGuestApplicationData;

    public function __construct(array $newGuestApplicationData)
    {
        $this->newGuestApplicationData = $newGuestApplicationData;
    }

    public function handle(): void
    {
        Mail::to('vvan@itmo.ru')->send(new AddNewGuestNotification($this->newGuestApplicationData));
    }
}
