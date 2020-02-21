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

}
