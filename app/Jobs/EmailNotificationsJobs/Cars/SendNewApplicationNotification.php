<?php

namespace App\Jobs\EmailNotificationsJobs\Cars;

use App\Mail\Notifications\Cars\NewCarApplicationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewApplicationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $carApplicationData;
    public function __construct(array $carApplicationData)
    {
        $this->carApplicationData = $carApplicationData;
    }

    public function handle(): void
    {
        Mail::to('security@example.com')->send(new NewCarApplicationNotification($this->carApplicationData));
    }
}
