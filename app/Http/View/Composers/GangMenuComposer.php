<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class GangMenuComposer
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
        $view->with('gang_menu', $this->getMenuData());
    }

    public function getMenuData()
    {
        return [
            'leases' => app('gang.dhcp')->number_of_leases,
            'service_files' => count(app('gang.dhcp')->service_files),
            'tftp_files' => count(app('gang.dhcp')->tftp_files),
            'import_files' => count(app('gang.dhcp')->files_for_import)
        ];
    }
}
