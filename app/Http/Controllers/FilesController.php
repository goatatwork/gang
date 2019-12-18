<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\BackchannelMessage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $file = null;
        $file_name = null;
        $return_to = $request->headers->get('referer');

        if ($request->load) {
            $file = Storage::disk('public')->get($request->load);
            $file = str_replace("\n","<br>",$file);
            $file_name = $request->load;
        }

        return view('files.index')->with('file', $file)->with('file_name', $file_name)->with('return_to', $return_to);
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
        $content = str_replace("<br>","\n",$request->content);
        $content = str_replace("<div>","",$content);
        $content = str_replace("</div>","",$content);

        Storage::disk('public')->put($request->load, $content);
        event(new BackchannelMessage($request->load.' was saved'));

        return redirect()->away($request->return_to)
            ->with('status', $request->load . ' has been saved');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Storage::disk('public')->delete($request->load);
        event(new BackchannelMessage($request->load.' was deleted'));

        return redirect()->route('dnsmasq.index')
            ->with('status', $request->load . ' has been deleted');
    }
}
