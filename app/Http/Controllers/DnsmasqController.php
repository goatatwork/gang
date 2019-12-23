<?php

namespace App\Http\Controllers;

use Storage;
use App\Bots\Dockerbot;
use Illuminate\Http\Request;
use App\Events\BackchannelMessage;

class DnsmasqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server_config_file = Storage::disk('public')->get('dhcp_configs/dnsmasq.conf');
        $leases_file = Storage::disk('public')->get('dhcp_leases/dnsmasq.leases');

        $number_of_leases = count(explode("\n", $leases_file)) - 1;

        $config_files = Storage::disk('public')->files('dhcp_configs/dnsmasq.d');
        $imports = Storage::disk('public')->files('imports');
        $tftp_files = Storage::disk('public')->allFiles('tftp_files');

        $dockerbot = new Dockerbot();
        $container = $dockerbot->getContainer('gang_dhcp');

        return view('dnsmasq.index')
            ->with('server_config_file', $server_config_file)
            ->with('leases_file', $leases_file)
            ->with('number_of_leases', $number_of_leases)
            ->with('config_files', $config_files)
            ->with('tftp_files', $tftp_files)
            ->with('imports', $imports)
            ->with('container', $container);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->routeIs('dnsmasq.reset')) {
            Storage::disk('public')->delete('dhcp_configs/dnsmasq.conf');

            Storage::disk('public')->copy('dhcp_configs/dnsmasq-conf-default', 'dhcp_configs/dnsmasq.conf');

            event(new BackchannelMessage('The dnsmasq.conf file has been reset to defaults'));

            return redirect()->route('dnsmasq.index')->with('status', 'The dnsmasq.conf file has been reset to defaults');
        }
        return redirect()->route('dnsmasq.index')->with('status', "I can't do that.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
