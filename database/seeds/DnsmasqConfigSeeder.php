<?php

use Illuminate\Database\Seeder;

class DnsmasqConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_dnsmasq_config_file = file_get_contents('database/seeds/dnsmasq.conf-default');
        $example_dnsmasq_config_file = file_get_contents('database/seeds/dnsmasq.conf-example');
        $dhcp_script = file_get_contents('database/seeds/dhcp-script.sh');

        $stored_default = \Storage::disk('public')->put('dhcp_configs/dnsmasq-conf-default', $default_dnsmasq_config_file);
        $stored_example = \Storage::disk('public')->put('dhcp_configs/dnsmasq-conf-example', $example_dnsmasq_config_file);
        $stored_dhcp_script = \Storage::disk('public')->put('dhcp_configs/dhcp-script.sh', $dhcp_script);
    }
}
