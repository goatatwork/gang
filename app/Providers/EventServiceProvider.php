<?php

namespace App\Providers;

use App\Events\ContainerAction;
use App\Listeners\HandleNewMedia;
use App\Events\BackchannelMessage;
use Illuminate\Auth\Events\Registered;
use App\Listeners\TakeActionOnContainer;
use App\Listeners\RecordBackchannelMessageToDb;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;
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
        BackchannelMessage::class => [
            RecordBackchannelMessageToDb::class,
        ],
        ContainerAction::class => [
            TakeActionOnContainer::class,
        ],
        MediaHasBeenAdded::class => [
            HandleNewMedia::class,
        ]
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
