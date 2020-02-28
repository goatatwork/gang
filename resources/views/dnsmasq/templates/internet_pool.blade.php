# DHCP Range For Internet On VLAN 400
dhcp-range=set:"INTERNET-10_0_25_0_24",10.0.25.1,10.0.25.253,255.255.255.0,5m
tag-if=set:internet-pool,tag:INTERNET-10_0_25_0_24
dhcp-option=tag:"INTERNET-10_0_25_0_24",3,10.0.25.254
dhcp-option=tag:"INTERNET-10_0_25_0_24",1,255.255.255.0
dhcp-option=tag:"INTERNET-10_0_25_0_24",5,8.8.8.8
dhcp-option=tag:"INTERNET-10_0_25_0_24",6,8.8.8.8
