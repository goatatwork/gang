<?php

use Illuminate\Database\Seeder;

class DnsmasqConfigTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_dnsmasq_config_file = file_get_contents('database/seeds/dnsmasq.conf-default');
        $default_dnsmasq_leases_file = file_get_contents('database/seeds/dnsmasq.leases-default');

        $stored_default_config = \Storage::disk('public')->put('dhcp_configs/dnsmasq.conf', $default_dnsmasq_config_file);
        $stored_default_leases = \Storage::disk('public')->put('dhcp_leases/dnsmasq.leases', $default_dnsmasq_leases_file);

    }
}
