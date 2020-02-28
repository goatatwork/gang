## Management IP for {{ $customer->name }} (ID:{{ $customer->id }})
dhcp-subscrid=set:"{{$subscriber_id}}","{{$subscriber_id}}"
dhcp-range=tag:"{{$subscriber_id}}",tag:!internet-pool,{{ $ip }},{{ $ip }},255.255.255.0,1800
dhcp-option=tag:"{{$subscriber_id}}",tag:!internet-pool,3,192.168.154.254
dhcp-option=tag:"{{$subscriber_id}}",tag:!internet-pool,1,255.255.255.0
dhcp-option=tag:"{{$subscriber_id}}",tag:!internet-pool,5,8.8.8.8
dhcp-option=tag:"{{$subscriber_id}}",tag:!internet-pool,6,8.8.8.8
dhcp-option=tag:"{{$subscriber_id}}",tag:!internet-pool,67,ont_profiles/zhone-2728a1/S04.01.223/200m-x-200m-inet-tv/S0401223
