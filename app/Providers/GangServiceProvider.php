<?php

namespace App\Providers;

use App\DhcpServer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GangServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('gang.dhcp', function($app) {
            return new DhcpServer();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'include.menu', 'App\Http\View\Composers\GangMenuComposer'
        );

        View::composer(
            'dnsmasq.index', 'App\Http\View\Composers\GangDhcpViewComposer'
        );
    }
}
