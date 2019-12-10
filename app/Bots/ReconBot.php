<?php

namespace App\Bots;

use App\Bots\Components\Telnet;

class ReconBot {

    public function telnet()
    {
        $telnet = new Telnet('192.168.127.1');

        if ($telnet->login('admin','password')) {
            $telnet->setPrompt('#');

            $telnet->execute('en','#');

            return $telnet->execute("show system info","#");
        }

        return false;
    }

}
