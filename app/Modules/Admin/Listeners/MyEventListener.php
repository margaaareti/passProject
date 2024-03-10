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
    {
        $sendingData = $event->sendingData;
        Mail::to($sendingData['email'])->send(new ApproveApplicationEmail($sendingData));
    }
}
