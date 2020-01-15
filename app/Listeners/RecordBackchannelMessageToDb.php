<?php

namespace App\Listeners;

use App\Events\BackchannelMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordBackchannelMessageToDb
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BackchannelMessage  $event
     * @return void
     */
    public function handle(BackchannelMessage $event)
    {
        $db = \App\BackchannelMessage::create(['message' => $event->message]);
    }
}
