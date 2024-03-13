<?php

namespace App\Modules\Admin;
use App\Modules\Admin\Events\SendApprovingEmailNotificationEvent;
use App\Modules\Admin\Listeners\MyEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class AdminServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendApprovingEmailNotificationEvent::class => [
            MyEventListener::class,
        ],
    ];

    public function boot(): void
    {
    }
}

