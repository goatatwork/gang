<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\BackchannelMessage;

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
                    event(new BackchannelMessage('New file uploaded: '.$file->getClientOriginalName()));
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

        $filename = Str::afterLast($request->load,"/");

        $extension = Str::afterLast($request->load,".");

        if ($extension == 'img') {
            $new = 'tftp_files/'.$filename;
        } else {
            $new = 'dhcp_configs/dnsmasq.d/'.$filename;
        }

        Storage::disk('public')->move($old,$new);

        event(new BackchannelMessage($filename.' has been imported to '.$new));

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
