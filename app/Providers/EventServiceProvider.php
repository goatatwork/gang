<?php

namespace App\Providers;

use App\Events\ContainerAction;
use App\Events\BackchannelMessage;
use Illuminate\Auth\Events\Registered;
use App\Listeners\TakeActionOnContainer;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BackchannelMessage::class => [],
        ContainerAction::class => [
            TakeActionOnContainer::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
