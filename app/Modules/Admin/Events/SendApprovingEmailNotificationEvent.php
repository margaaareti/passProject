<?php

namespace App\Modules\Admin\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendApprovingEmailNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $sendingData;

    public function __construct($sendingData)
    {
        $this->sendingData = $sendingData;
    }

}
