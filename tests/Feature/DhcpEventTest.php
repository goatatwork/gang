<?php

namespace Tests\Feature;

use App\DhcpEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DhcpEventTest extends TestCase
{
    /**
     * @group api
     * @test
     * @return void
     */
    public function DhcpEvents_have_things()
    {
        $event = factory(DhcpEvent::class)->make();
        $post_data = $event->attributesToArray();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-CSRF-TOKEN' => 'LGri4hy2pGlx9wVpVvVqTHRwwavZVn2vYu2PS4a2'
        ])->json('POST', '/api/dnsmasq/events', $post_data);

        $response->assertStatus(200);
    }
}
