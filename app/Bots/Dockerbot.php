<?php

namespace App\Bots;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Dockerbot
{
    /**
     * The path to our access to the Docker API
     * @var string
     */
    public $base_uri;

    /**
     * The Docker API version
     * @var string
     */
    public $api_version;

    /**
     * The API endpoint path to hit
     * @var string
     */
    public $path;

    /**
     * The construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->base_uri = 'http://socat:2375';
        $this->api_version = 'v1.40';
        $this->path = '';
    }

    public function getContainer($name)
    {
        $path = 'containers/' . $name . '/json';

        $client = new Client();

        $request = $client->get($this->base_uri . '/' . $this->api_version . '/' . $path);
        $response = $request->getBody();

        $assocArray = json_decode($response->getContents(), true);

        return $assocArray;
    }

    public function stopContainer($name)
    {
        $path = 'containers/' . $name . '/stop';

        $client = new Client();

        $request = $client->post($this->base_uri . '/' . $this->api_version . '/' . $path);

        $response = $request->getStatusCode(); // 204 == love

        $assocArray = json_decode($response, true);

        return $assocArray;
    }

    public function startContainer($name)
    {
        $path = 'containers/' . $name . '/start';

        $client = new Client();

        $request = $client->post($this->base_uri . '/' . $this->api_version . '/' . $path);

        $response = $request->getStatusCode(); // 204 == love

        $assocArray = json_decode($response, true);

        return $assocArray;
    }

    public function restartContainer($name)
    {
        $path = 'containers/' . $name . '/restart';

        $client = new Client();

        $request = $client->post($this->base_uri . '/' . $this->api_version . '/' . $path);

        $response = $request->getStatusCode(); // 204 == love

        $assocArray = json_decode($response, true);

        return $assocArray;
    }
}
