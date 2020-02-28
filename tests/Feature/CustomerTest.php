<?php

namespace Tests\Feature;

use File;
use Storage;
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

    /**
     * @group customers
     * @test
     * @return void
     */
    public function test_Customer_can_create_zhone_management_dhcp_config_files()
    {
        // Storage::fake('local');
        Storage::fake('customer_files');
        $customer = factory(Customer::class)->create();

        $this->assertCount(0, $customer->getMedia('dhcp_configs'));

        $customer = $customer->refresh()->provisionDhcp('zhone_management','192.168.99.222','testSubScrId');

        $this->assertCount(1, $customer->refresh()->getMedia('dhcp_configs'));

    }

    protected function renderView()
    {
        return view('dnsmasq.templates.zhone_management')
            ->with('subscriber_id', 'testSubScrId')
            ->with('customer', $customer)
            ->with('ip', '192.168.99.222')
            ->render();
    }
}
