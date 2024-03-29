<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Events\BackchannelMessage;
use App\Http\Requests\CustomerProvisioningRequest;

class CustomerProvisioningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  App\Http\Requests\CustomerProvisioningRequest  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerProvisioningRequest $request, Customer $customer)
    {
        $customer->provisionDhcp($request->template, $request->ip, $request->subscriber_id);

        event(new BackchannelMessage('Provisioning '.$customer->poc_name.' at '.$request->ip.'.'));

        return back()->with('status','Provisioning '.$customer->poc_name.' at '.$request->ip.'.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->unprovisionDhcp();

        event(new BackchannelMessage('Removed provisioning for '.$customer->poc_name.'.'));

        return back()->with('status','Removed provisioning for '.$customer->poc_name.'.');
    }
}
