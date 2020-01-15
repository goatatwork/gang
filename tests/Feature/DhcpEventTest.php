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
    use RefreshDatabase;

    /**
     * @group api
     * @test
     * @return void
     */
    public function DhcpEvents_are_recorded_in_the_database()
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

        $this->assertCount(1, DhcpEvent::all());

        Event::assertDispatched(BackchannelMessage::class);
    }

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

        $this->assertCount(1, DhcpEvent::all());
    }

    /**
     * @group api
     * @test
     * @return void
     */
    public function BackchannelMessages_are_recorded_in_the_database()
    {
        $event = factory(DhcpEvent::class)->make();
        $post_data = $event->attributesToArray();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-CSRF-TOKEN' => 'LGri4hy2pGlx9wVpVvVqTHRwwavZVn2vYu2PS4a2'
        ])->json('POST', '/api/dnsmasq/events', $post_data);

        $response->assertStatus(200);

        $this->assertCount(1, DhcpEvent::all());

        $this->assertCount(1, \App\BackchannelMessage::all());

        $this->assertTrue((\App\BackchannelMessage::first())->active);
    }
}
