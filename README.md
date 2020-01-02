Gang
DHCP and Subscriber Management System
By: Goat <ryantgray@gmail.com>

# Installation

`php artisan db:seed --class=DnsmasqConfigSeeder` will copy `database/seeds/dnsmasq.conf-default` and `database/seeds/dnsmasq.conf-example` to same-named files in `dhcp_configs/`.

The `-example` file is a copy of the `dnsmasq.conf` with all of the author's comments.

The `-default` file is the file that *dnsmasq* will be using to boot with. The copy of this file created by the seeder, `dhcp_configs/dnsmasq-conf-default`, is the file that will be used when resetting the `dnsmasq.conf` to defaults.
