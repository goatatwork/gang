<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\BackchannelMessage as Backchannel;

class BackchannelMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backchannel:send {message?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a message through the backchannel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $message = ($this->argument('message')) ? $this->argument('message') : $this->ask('What would you like to send to the backchannel?');

        event(new Backchannel($message));

        if (!$this->argument('message')) {
            $this->info('Roger that.');
            $this->info('I sent: "' . $message . '" to the backchannel.');
        }
    }
}
