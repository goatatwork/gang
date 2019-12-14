<?php

namespace App\Listeners;

use App\Bots\Dockerbot;
use App\Events\ContainerAction;
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
            $bot->restartContainer('gang_dhcp');
            \Log::info('I should '.$event->action.' gang_dhcp container.');
        }
        if ($event->action == 'stop') {
            $bot->stopContainer('gang_dhcp');
            \Log::info('I should '.$event->action.' gang_dhcp container.');
        }
        if ($event->action == 'start') {
            $bot->startContainer('gang_dhcp');
            \Log::info('I should '.$event->action.' gang_dhcp container.');
        }
    }
}
