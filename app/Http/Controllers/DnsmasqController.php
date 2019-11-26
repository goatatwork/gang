<?php

namespace App\Http\Controllers;

use Storage;
use App\Bots\Dockerbot;
use Illuminate\Http\Request;

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
        $config_files = Storage::disk('public')->files('dhcp_configs/dnsmasq.d');

        $dockerbot = new Dockerbot();
        $container = $dockerbot->getContainer('gang_dhcp');

        return view('dnsmasq.index')
            ->with('server_config_file', $server_config_file)
            ->with('leases_file', $leases_file)
            ->with('config_files', $config_files)
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
    public function update(Request $request, $id)
    {
        //
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
