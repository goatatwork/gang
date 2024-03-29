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

Route::get('/', 'HomeController@index')->name('home');

Route::get('recon', 'ReconController@index')->name('recon.index');

Route::prefix('provisioning')->group(function() {
    Route::get('customers', 'CustomerController@index')->name('customers.index');
    Route::get('customers/{customer}', 'CustomerController@show')->name('customers.show');
    Route::post('customers/{customer}', 'CustomerProvisioningController@store')->name('customers.provision');
    Route::delete('customers/{customer}', 'CustomerProvisioningController@destroy')->name('customers.unprovision');
});

Route::get('backups', 'BackupsController@index')->name('backups.index');
Route::post('backups', 'BackupsController@store')->name('backups.create');
Route::get('backups/{snapshot}/load', 'BackupsController@load')->name('backups.load');
Route::delete('backups/{snapshot}', 'BackupsController@destroy')->name('backups.destroy');
Route::get('backups/{snapshot}/download', 'BackupsController@download')->name('backups.download');

Route::get('dnsmasq/{section?}', 'DnsmasqController@index')->name('dnsmasq.index');
Route::patch('dnsmasq/reset', 'DnsmasqController@update')->name('dnsmasq.reset');

Route::get('backchannel', 'BackchannelMessageController@index')->name('backchannel.index');
Route::patch('backchannel/{backchannelMessage}/markread', 'BackchannelMessageController@update')->name('backchannel.markread');

Route::get('files', 'FilesController@index')->name('files.index');
Route::post('files', 'FilesController@store')->name('files.store');
Route::delete('files', 'FilesController@destroy')->name('files.destroy');
Route::get('files/download', 'FilesController@download')->name('files.download');

Route::post('imports', 'ImportsController@store')->name('imports.store');
Route::patch('imports', 'ImportsController@update')->name('imports.update');

Route::patch('dockerbot', 'DockerbotController@update')->name('dockerbot.update');

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
