<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = QueryBuilder::for(Customer::class)->allowedFilters([
            AllowedFilter::exact('id'),
            'name',
            'poc_name',
            'poc_email',
            'phone1',
            'phone2',
            'address1',
            'address2',
            'city',
            'state',
            'zip',
            'notes',
            'created_at',
            'updated_at'
        ])->allowedSorts([
            'name',
            'poc_name',
            'poc_email',
            'phone1',
            'phone2',
            'address1',
            'address2',
            'city',
            'state',
            'zip',
            'notes',
            'created_at',
            'updated_at'
        ])->paginate(25);

        return view('provisioning.customers.index')->with('customers',$customers);
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('provisioning.customers.show')->with('customer',$customer);
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
        //
    }
}
