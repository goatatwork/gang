<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImportsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->files_to_import) {
            foreach ($request->files_to_import as $file) {
                if ($file->isValid()) {
                    $file->storeAs('imports',$file->getClientOriginalName(),'public');
                }
            }
        }

        return redirect()->route('dnsmasq.index')
            ->with('status', 'Upload successful');
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
        $old = $request->load;
        $new = 'dhcp_configs/dnsmasq.d/'.Str::afterLast($request->load,"/");

        Storage::disk('public')->move($old,$new);

        return redirect()->route('dnsmasq.index')
            ->with('status', Str::afterLast($request->load,"/") . ' has been imported');
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
