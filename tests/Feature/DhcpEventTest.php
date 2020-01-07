<?php

namespace Tests\Feature;

use App\DhcpEvent;
use Tests\TestCase;
use App\Events\BackchannelMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DhcpEventTest extends TestCase
{
    /**
     * @group api
     * @test
     * @return void
     */
    public function DhcpEvents_fire_BackchannelMessage_for_fake()
    {
        Event::fake();

        $event = factory(DhcpEvent::class)->make();
        $post_data = $event->attributesToArray();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-CSRF-TOKEN' => 'LGri4hy2pGlx9wVpVvVqTHRwwavZVn2vYu2PS4a2'
        ])->json('POST', '/api/dnsmasq/events', $post_data);

        $response->assertStatus(200);

        Event::assertDispatched(BackchannelMessage::class);
    }

    /**
     * @group api
     * @test
     * @return void
     */
    public function DhcpEvents_fire_BackchannelMessage_for_real()
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
