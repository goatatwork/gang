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
    public function index($section = '')
    {
        $dockerbot = new Dockerbot();
        $container = $dockerbot->getContainer(config('gang.dhcp_container_name'));

        return view('dnsmasq.index')
            ->with('container', $container)
            ->with('section', $section);
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
            Storage::disk('public')->delete(config('gang.dhcp_config_file_location'));

            Storage::disk('public')->copy('dhcp_configs/dnsmasq-conf-default', config('gang.dhcp_config_file_location'));

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
