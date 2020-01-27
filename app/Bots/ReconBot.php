<?php

namespace App\Bots;

use \JJG\Ping;
use App\Bots\Components\Telnet;

class ReconBot {

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

    public function zhoneOntBridgedMacAll($ip)
    {
        $telnet = new Telnet($ip);

        if ($telnet->login('admin','password')) {
            $telnet->setPrompt('#');

            $telnet->execute('en','#');

            return $telnet->execute("show interface bridged mac all","#");
        }

        return false;
    }

    public function ping($ip)
    {
        $host = $ip;

        $ping = new Ping($host);

        $latency = $ping->ping();

        return $latency;
        // if ($latency !== false) {
        //     return true;
        // }

        // return false;
    }
}
