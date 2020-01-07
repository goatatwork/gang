<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DhcpEvent;
use Faker\Generator as Faker;

$factory->define(DhcpEvent::class, function (Faker $faker) {
    return [
        'ACTION' => 'add',
        'HOSTMAC' => '00:02:71:40:b8:aa',
        'IP' => '192.168.127.2',
        'HOSTNAME' => 'none',
        'DNSMASQ_LEASE_EXPIRES' => '1578344570',
        'DNSMASQ_LEASE_LENGTH' => 'DNSMASQ_LEASE_LENGTH',
        'DNSMASQ_DOMAIN' => 'DNSMASQ_DOMAIN',
        'DNSMASQ_SUPPLIED_HOSTNAME' => 'DNSMASQ_SUPPLIED_HOSTNAME',
        'DNSMASQ_TIME_REMAINING' => '300',
        'DNSMASQ_OLD_HOSTNAME' => 'DNSMASQ_OLD_HOSTNAME',
        'DNSMASQ_INTERFACE' => 'br0',
        'DNSMASQ_RELAY_ADDRESS' => '192.168.127.254',
        'DNSMASQ_TAGS' => 'basementstack/1/1/1 br0',
        'DNSMASQ_LOG_DHCP' => '1',
        'DNSMASQ_CLIENT_ID' => '00:33:30:34:32:34:31:35:37',
        'DNSMASQ_CIRCUIT_ID' => 'DNSMASQ_CIRCUIT_ID',
        'DNSMASQ_SUBSCRIBER_ID' => "basementstack/1/1/1",
        'DNSMASQ_REMOTE_ID' => 'DNSMASQ_REMOTE_ID',
        'DNSMASQ_VENDOR_CLASS' => 'GE-2426A-0GF',
        'DNSMASQ_REQUESTED_OPTIONS' => '1,3,6,12,15,28,51,53,54,66,42,2,120,121',
        'DNSMASQ_SCRIPT_ENVIRONMENT' => 'Mon Jan  6 14:57:50 CST 202'
    ];
});
