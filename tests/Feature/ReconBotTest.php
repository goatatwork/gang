<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReconBotTest extends TestCase
{
    /**
     * @group reconbot
     * @test
     * @return void
     */
    public function test_ReconBot_is_registered_at_boot()
    {
        $this->assertInstanceOf(\App\Bots\ReconBot::class, app('reconbot'));
    }

}
