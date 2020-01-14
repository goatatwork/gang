<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class GangDhcpViewComposer
{
    /**
     * Create a new gang_menu composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('server_config_file', app('gang.dhcp')->config_file)
            ->with('leases_file', app('gang.dhcp')->leases_file)
            ->with('number_of_leases', app('gang.dhcp')->number_of_leases)
            ->with('config_files', app('gang.dhcp')->service_files)
            ->with('tftp_files', app('gang.dhcp')->tftp_files)
            ->with('imports', app('gang.dhcp')->files_for_import);
    }
}
