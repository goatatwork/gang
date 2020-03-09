<?php

namespace Tests\Feature;

use Storage;
use App\Customer;
use DnsmasqConfigTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvisioningTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group provisioning
     * @test
     * @return void
     */
    public function test_a_customer_can_be_provisioned_and_removed_via_the_web_form_data()
    {
        $customer = factory(Customer::class)->create();

        $this->assertFalse($customer->provisioned);

        $formData = ['template'=>'zhone_management','ip'=>'192.168.99.33','subscriber_id'=>'testSubScrbrId'];

        $response = $this->post('/provisioning/customers/'.$customer->id, $formData);

        $response->assertStatus(302); // redirects back()

        $this->assertTrue($customer->refresh()->provisioned);

        $file = $customer->refresh()->getMedia('dhcp_configs')->last();

        Storage::disk('customer_files')->assertExists(
            $file->id.'/zhone_management-192_168_99_33-c_'.$customer->id.'.conf'
        );
        Storage::disk('public')->assertExists(
            'dhcp_configs/dnsmasq.d/zhone_management-192_168_99_33-c_'.$customer->id.'.conf'
        );

        $this->assertEquals(
            'zhone_management', $customer->getMedia('dhcp_configs')->last()->getCustomProperty('template')
        );

        $this->assertEquals(
            '192.168.99.33', $customer->getMedia('dhcp_configs')->last()->getCustomProperty('ip')
        );

        $this->assertEquals(
            'testSubScrbrId', $customer->getMedia('dhcp_configs')->last()->getCustomProperty('subscriber_id')
        );

        $response1 = $this->delete('/provisioning/customers/'.$customer->id);

        $response1->assertStatus(302); // redirects back()

        $this->assertFalse($customer->refresh()->provisioned);

        Storage::disk('customer_files')->assertMissing(
            $file->id.'/zhone_management-192_168_99_33-c_'.$customer->id.'.conf'
        );

        Storage::disk('public')->assertMissing(
            'dhcp_configs/dnsmasq.d/zhone_management-192_168_99_33-c_'.$customer->id.'.conf'
        );

    }

}
