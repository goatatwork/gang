<?php

namespace App\Http\Controllers;

use App\BackchannelMessage;
use Illuminate\Http\Request;

class BackchannelMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = BackchannelMessage::latest()->get();

        return view('backchannel.index')->with('messages', $messages);
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
     * @param  \App\BackchannelMessage  $backchannelMessage
     * @return \Illuminate\Http\Response
     */
    public function show(BackchannelMessage $backchannelMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BackchannelMessage  $backchannelMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(BackchannelMessage $backchannelMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BackchannelMessage  $backchannelMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BackchannelMessage $backchannelMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BackchannelMessage  $backchannelMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BackchannelMessage $backchannelMessage)
    {
        //
    }
}
