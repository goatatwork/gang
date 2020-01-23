<?php

namespace App\Bots;

use App\Bots\Components\Telnet;

class ReconBot {

    public function telnet($ip)
    {
        $telnet = new Telnet($ip);

        if ($telnet->login('admin','password')) {
            $telnet->setPrompt('#');

            $telnet->execute('en','#');

            return $telnet->execute("show system info","#");
        }

        return false;
    }

    public function zhoneOntSystemInfo($ip)
    {
        $telnet = new Telnet($ip);

        if ($telnet->login('admin','password')) {
            $telnet->setPrompt('#');

            $telnet->execute('en','#');

            return $telnet->execute("show system info","#");
        }

        return false;
    }
}
