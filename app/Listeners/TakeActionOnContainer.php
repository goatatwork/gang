<?php

namespace App\Listeners;

use App\Bots\Dockerbot;
use App\Events\ContainerAction;
use App\Events\BackchannelMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TakeActionOnContainer
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
     * @param  ContainerAction  $event
     * @return void
     */
    public function handle(ContainerAction $event)
    {
        $bot = new Dockerbot();

        if ($event->action == 'restart') {
            $botResponse = $bot->restartContainer('gang_dhcp');
            event(new BackchannelMessage('Dockerbot dhcp '.$event->action.' returned '.$botResponse));
            \Log::notice('Dockerbot dhcp '.$event->action.' returned '.$botResponse);
        }
        if ($event->action == 'stop') {
            $botResponse = $bot->stopContainer('gang_dhcp');
            event(new BackchannelMessage('Dockerbot dhcp '.$event->action.' returned '.$botResponse));
            \Log::notice('Dockerbot dhcp '.$event->action.' returned '.$botResponse);
        }
        if ($event->action == 'start') {
            $botResponse = $bot->startContainer('gang_dhcp');
            event(new BackchannelMessage('Dockerbot dhcp '.$event->action.' returned '.$botResponse));
            \Log::notice('Dockerbot dhcp '.$event->action.' returned '.$botResponse);
        }
    }
}
