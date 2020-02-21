<?php

namespace App\Http\Controllers;

use Artisan;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\BackchannelMessage;

class BackupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk('snapshots');

        $files = $disk->files();

        $files = collect($files);

        $files = $files->map(function($file) use ($disk) {
            return [
                'name' => $file,
                'size' => number_format(($disk->size($file) / 1024), 1).'K',
                'lastModified' => Carbon::createFromTimestamp($disk->lastModified($file))->toDateTimeString(),
            ];
        })->sortByDesc('lastModified');

        return view('backups.index')->with('snapshots', $files);
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
        $timestamp = Carbon::now()->format('Y-m-d-H-i-s');

        $snapshot_name = 'snapshot-'.$timestamp;

        Artisan::call('snapshot:create', ['name' => $snapshot_name]);

        event(new BackchannelMessage($snapshot_name . ' has been created.'));

        return back()->with('status', $snapshot_name . ' has been created.');
    }

    /**
     * Load the specified database backup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function load($snapshot)
    {
        $snapshot_name = Str::before($snapshot, '.sql');

        Artisan::call('snapshot:load', ['name' => $snapshot_name]);

        event(new BackchannelMessage($snapshot_name . ' has been loaded.'));

        return back()->with('status', $snapshot_name . ' has been loaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($snapshot)
    {
        event(new BackchannelMessage($snapshot . ' has been downloaded.'));

        return Storage::disk('snapshots')->download($snapshot);
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
    public function destroy($snapshot)
    {
        $snapshot_name = Str::before($snapshot, '.sql');

        Artisan::call('snapshot:delete', ['name' => $snapshot_name]);

        event(new BackchannelMessage($snapshot_name . ' has been deleted.'));

        return back()->with('status', $snapshot_name . ' has been deleted.');
    }
}
