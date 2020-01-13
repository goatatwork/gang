Gang
DHCP and Subscriber Management System
By: Goat <ryantgray@gmail.com>

# Installation

`php artisan db:seed --class=DnsmasqConfigSeeder` will copy `database/seeds/dnsmasq.conf-default` and `database/seeds/dnsmasq.conf-example` to same-named files in `dhcp_configs/`.

The `-example` file is a copy of the `dnsmasq.conf` with all of the author's comments.

The `-default` file is the file that *dnsmasq* will be using to boot with. The copy of this file created by the seeder, `dhcp_configs/dnsmasq-conf-default`, is the file that will be used when resetting the `dnsmasq.conf` to defaults.

# Example DNSMASQ dhcp-script data

```
{
    "ACTION": "old",
    "HOSTMAC":"00:02:71:40:b8:aa",
    "IP":"192.168.127.2",
    "HOSTNAME":"none",
    "DNSMASQ_LEASE_EXPIRES":"1578165986",
    "DNSMASQ_LEASE_LENGTH":"DNSMASQ_LEASE_LENGTH",
    "DNSMASQ_DOMAIN":"DNSMASQ_DOMAIN",
    "DNSMASQ_SUPPLIED_HOSTNAME":"DNSMASQ_SUPPLIED_HOSTNAME",
    "DNSMASQ_TIME_REMAINING":"300",
    "DNSMASQ_OLD_HOSTNAME":"DNSMASQ_OLD_HOSTNAME",
    "DNSMASQ_INTERFACE":"br0",
    "DNSMASQ_RELAY_ADDRESS":"192.168.127.254",
    "DNSMASQ_TAGS":"basementstack/1/1/1 br0",
    "DNSMASQ_LOG_DHCP":"1",
    "DNSMASQ_CLIENT_ID":"00:33:30:34:32:34:31:35:37",
    "DNSMASQ_CIRCUIT_ID":"DNSMASQ_CIRCUIT_ID",
    "DNSMASQ_SUBSCRIBER_ID":"basementstack/1/1/1",
    "DNSMASQ_REMOTE_ID":"DNSMASQ_REMOTE_ID",
    "DNSMASQ_VENDOR_CLASS":"GE-2426A-0GF",
    "DNSMASQ_REQUESTED_OPTIONS":"1,3,6,12,15,28,51,53,54,66,42,2,120,121"
}
```
