<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('dnsmasq/events', function(\Illuminate\Http\Request $request) {
    $eventJson = $request->getContent();
    $event1 = json_decode($eventJson, true);  // good assoc array
    $message = 'shit';
    // $message = $event1['ACTION'] . ' - ' . $event1['IP'] . ' - ' $event1['HOSTMAC'];

    \Log::notice($message);
});
