<?php

namespace App;

use Storage;
use Illuminate\Support\Str;

trait OwnsDhcpFilesTrait
{
    /**
     * Creates the file format for the dhcp files. It is important that the
     * template be the first part of the file, followed immediately by a dash.
     * Also, the very end of the filename should be a dash, and then a model
     * indicator (like "c" for customer) immediately followed by the model's
     * ID. The whole thing will look like zhone_management-192_168_10_1-c_2.conf
     *
     * @param  string $template matches a blade template in views/dnsmasq/templates
     * @param  string $ip The IP address to use
     * @return string The filename to use
     */
    public function makeDhcpFilename(string $template, string $ip)
    {
        return $template . '-' . preg_replace('/\./','_', $ip) . '-c_' . $this->id . '.conf'; // -c- = Customer
    }

    /**
     * [provisionDhcp description]
     * @param  string $template
     * @param  string $ip
     * @param  string $subscriber_id
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function provisionDhcp(string $template, string $ip, string $subscriber_id)
    {
        $temp_file = $this->getTempDisk()
            ->put($this->getTempDestination($template, $ip), $this->renderTemplate($template, $ip, $subscriber_id));

        $path = $this->getTempDisk()->path($this->getTempDestination($template, $ip));

        $file = $this->addMedia($path)->toMediaCollection('dhcp_configs'); // this fires MediaHasBeenAdded;

        return $file;
    }

    /**
     * Get dhcp files for this model
     * @param  string|null $template List all files or all file created by a particular template
     * @return collection
     */
    public function dhcpFiles(string $template = null)
    {
        if (! $template) {
            return $this->filesOnServer()->filter(function($file) {
                return $this->getModelIdFromFilename($file) == $this->id;
            });
        }

        return $this->filesOnServer()->filter(function($file) use ($template) {
            return $this->getModelIdFromFilename($file) == $this->id && $this->getTemplateFromFilename($file) == $template;
        });
    }

    /**
     * Give us a template, or not, and we'll start whacking files
     *
     * @param  string|null $template [description]
     * @return void
     */
    public function unprovisionDhcp(string $template = null) : void
    {
        $this->getMedia('dhcp_configs')->last()->delete();

        $this->dhcpFiles($template)->each(function($file) {

            app('gang.dhcp')->removeServiceFile($file);

        });
    }

    /**
     * List files in dnsmasq.d
     * @return collection The list of files in dnsmasq.d
     */
    protected function filesOnServer()
    {
        return collect(\Storage::disk('public')->files('dhcp_configs/dnsmasq.d'));
    }

    /**
     * Strip everything except the model's ID from the filename
     * @param  string $file Path to file like dhcp_configs/dnsmasq.d/zhone_management-192_168_10_1-c_2.conf
     * @return string
     */
    protected function getModelIdFromFilename(string $file)
    {
        $model_info_dot_conf = Str::afterLast($file, '-');

        $model_number_dot_conf = Str::afterLast($model_info_dot_conf, '_');

        $model_id = Str::before($model_number_dot_conf, '.');

        return $model_id;
    }

    /**
     * Strip everything except the template part of the filename
     * @param  string $file Path to file like dhcp_configs/dnsmasq.d/zhone_management-192_168_10_1-c_2.conf
     * @return string
     */
    protected function getTemplateFromFilename(string $file)
    {
        $filename = Str::afterLast($file, '/');

        $template = Str::before($filename, '-');

        return $template;
    }

    /**
     * Where the initial file will be temporarily written to.
     * @param  string $template
     * @param  string $ip
     * @return string Path to temporary file
     */
    protected function getTempDestination(string $template, string $ip)
    {
        return 'temp/dhcp/' . $this->makeDhcpFilename($template, $ip);
    }

    /**
     * The configured disk to use temporarily to write the file before
     * it gets sucked into MediaLibrary.
     * @return Illuminate\Filesystem\FilesystemAdapter
     */
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
