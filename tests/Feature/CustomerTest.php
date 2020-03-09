<?php

namespace Tests\Feature;

use File;
use Storage;
use App\Customer;
use Tests\TestCase;
use DnsmasqConfigTestSeeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    public function test_dhcp_files_for_zhone_management_can_be_generated()
    {
        Event::fake();
        Storage::fake('public');
        Storage::fake('customer_files');

        $this->seed(DnsmasqConfigTestSeeder::class);

        $customer = factory(Customer::class)->create();

        $this->assertCount(0, $customer->getMedia('dhcp_configs'));

        $file = $customer->provisionDhcp('zhone_management','192.168.100.1','testSubScrId');

        $this->assertCount(1, $customer->refresh()->getMedia('dhcp_configs'));
    }

    /**
     * @group customers
     * @test
     * @return void
     */
    public function test_MediaHasBeenAdded_event_is_fired_when_a_new_dhcp_file_is_added_for_a_Customer()
    {
        Event::fake();
        Storage::fake('public');
        Storage::fake('customer_files');

        $this->seed(DnsmasqConfigTestSeeder::class);

        $customer = factory(Customer::class)->create();

        $this->assertCount(0, $customer->getMedia('dhcp_configs'));

        $file = $customer->refresh()->provisionDhcp('zhone_management','192.168.200.1','testSubScrId');

        $this->assertCount(1, $customer->refresh()->getMedia('dhcp_configs'));

        Event::assertDispatched(MediaHasBeenAdded::class);
    }

    /**
     * @group customers
     * @test
     * @return void
     */
    public function test_Customer_can_create_and_delete_zhone_management_dhcp_config_files()
    {
        // $this->seed(DnsmasqConfigTestSeeder::class);

        $customer = factory(Customer::class)->create();

        $this->assertFalse($customer->provisioned);

        $this->assertCount(0, $customer->getMedia('dhcp_configs'));

        $file = $customer->provisionDhcp('zhone_management','192.168.211.1','testSubScrId');

        Storage::disk('customer_files')->assertExists('/'.$file->id.'/'.$file->file_name);
        Storage::disk('public')->assertExists('dhcp_configs/dnsmasq.d/'.$file->file_name);

        $this->assertTrue($customer->refresh()->provisioned);

        $customer->unprovisionDhcp('zhone_management');

        Storage::disk('customer_files')->assertMissing('/'.$file->id.'/'.$file->file_name);
        Storage::disk('public')->assertMissing('dhcp_configs/dnsmasq.d/'.$file->file_name);
    }
}
