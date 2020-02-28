<?php

namespace App;

use Storage;

trait OwnsDhcpFilesTrait
{
    public function provisionDhcp(string $template, string $ip, string $subscriber_id)
    {
        $temp_file = $this->getTempDisk()
            ->put($this->getTempDestination($ip), $this->renderTemplate($template, $ip, $subscriber_id));

        $path = $this->getTempDisk()->path($this->getTempDestination($ip));

        $this->addMedia($path)->toMediaCollection('dhcp_configs');

        return $this;
    }

    protected function makeDhcpFilename($ip)
    {
        return preg_replace('/\./','_', $ip) . '-c-' . $this->id . '.conf';
    }

    protected function getTempDestination($ip)
    {
        return 'temp/dhcp/' . $this->makeDhcpFilename($ip);
    }

    protected function getTempDisk()
    {
        return Storage::disk('local');
    }

    /**
     * Render the given template
     * @param  string $template the name of the blade.php file in dnsmasq.templates
     * @param  string $ip The IP to use for management
     * @param  string $subscriber_id The subscriber id coming from the relay
     * @return Illuminate\View\View Rendered page
     */
    protected function renderTemplate(string $template, string $ip, string $subscriber_id) {
        return view('dnsmasq.templates.'.$template)
            ->with('subscriber_id', $subscriber_id)
            ->with('customer', $this)
            ->with('ip', $ip)
            ->render();
    }
}
