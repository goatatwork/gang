<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group customers
     * @test
     * @return void
     */
    public function test_A_customer_can_exist()
    {
        $customer = factory(Customer::class)->create();

        $this->assertDatabaseHas('customers', $customer->toArray());
    }

    /**
     * @group customers
     * @test
     * @return void
     */
    public function test_A_customer_has_a_MediaCollection_named_dhcp_configs()
    {
        $customer = factory(Customer::class)->create();

        $this->assertNotNull($customer->getMediaCollection('dhcp_configs'));

        $this->assertInstanceOf('Spatie\MediaLibrary\MediaCollection\MediaCollection', $customer->getMediaCollection('dhcp_configs'));
    }

}
