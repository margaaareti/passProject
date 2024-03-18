<?php

namespace App\Modules\Admin\Listeners;

use App\Modules\Admin\Events\SendApprovingEmailNotificationEvent;
use App\Modules\Admin\Mails\ApproveApplicationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class MyEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {

    }

    public function handle(SendApprovingEmailNotificationEvent $event): void
    {   Log::info("Вызов отправки мыла");
        $sendingData = $event->sendingData;
        $sendingData['response']  = match ($sendingData['app_type']){
            "Проход" => config('email_responses.guest_approved'),
            "Въезд" => config('email_responses.car_approved'),
            default => null,
        };

        Mail::to($sendingData['email'])->send(new ApproveApplicationEmail($sendingData));
    }
}
