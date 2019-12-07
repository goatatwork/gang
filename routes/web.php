<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('files', 'FilesController@index')->name('files.index');
Route::post('files', 'FilesController@store')->name('files.store');

Route::get('dnsmasq', 'DnsmasqController@index')->name('dnsmasq.index');

Route::get('containers', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/containers/json');
    $response = $request->getBody();
    $jsonResponse = json_decode($response->getContents());

    dd($jsonResponse);
});

Route::get('images', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/images/json');
    $response = $request->getBody();

    dd($response);
});

Route::get('info', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/info');
    $response = $request->getBody();

    dd($response);
});

Route::get('version', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/version');
    $response = $request->getBody();

    dd($response);
});

Route::get('_ping', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/_ping');
    $response = $request->getBody();

    dd($response);
});

Route::get('volumes', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/volumes');
    $response = $request->getBody();

    dd($response);
});

Route::get('networks', function() {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('http://socat:2375/v1.40/networks');
    $response = $request->getBody();

    dd($response);
});
