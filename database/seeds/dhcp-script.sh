#!/bin/bash
# 20180406 Goat
# Dnsmasq Webhook for GoldAccess
# Use this with the dnsmasq config paramater
#
# dhcp-script=/usr/local/bin/dhcp-script.sh

destination="10.200.200.1"
#destination="10.13.13.10:8088"

action=${1:-none}
mac=${2:-none}
ip=${3:-none}
hostname=${4:-none}

# If the fully-qualified domain name of the host is known, this is set to the
# domain part. (Note that the hostname passed to the script as an argument is
# never fully-qualified.)
DNSMASQ_DOMAIN=${DNSMASQ_DOMAIN:-'DNSMASQ_DOMAIN'}

# If the client provides a hostname
DNSMASQ_SUPPLIED_HOSTNAME=${DNSMASQ_SUPPLIED_HOSTNAME:-'DNSMASQ_SUPPLIED_HOSTNAME'}

# If dnsmasq was compiled with HAVE_BROKEN_RTC, then the length of the lease
# (in seconds) is stored in DNSMASQ_LEASE_LENGTH, otherwise the time of lease
# expiry is stored in DNSMASQ_LEASE_EXPIRES. The number of seconds until lease
# expiry is always stored in DNSMASQ_TIME_REMAINING
DNSMASQ_LEASE_LENGTH=${DNSMASQ_LEASE_LENGTH:-'DNSMASQ_LEASE_LENGTH'}
DNSMASQ_LEASE_EXPIRES=${DNSMASQ_LEASE_EXPIRES:-'DNSMASQ_LEASE_EXPIRES'}
DNSMASQ_TIME_REMAINING=${DNSMASQ_TIME_REMAINING:-'DNSMASQ_TIME_REMAINING'}

# If a lease used to have a hostname, which is removed, an "old" event is
# generated with the new state of the lease, ie no name, and the former name is
# provided in this environment variable
DNSMASQ_OLD_HOSTNAME=${DNSMASQ_OLD_HOSTNAME:-'DNSMASQ_OLD_HOSTNAME'}

# This stores the name of the interface on which the request arrived; this is
# not set for "old" actions when dnsmasq restarts.
DNSMASQ_INTERFACE=${DNSMASQ_INTERFACE:-'DNSMASQ_INTERFACE'}

# This is set if the client used a DHCP relay to contact dnsmasq and the IP
# address of the relay is known
DNSMASQ_RELAY_ADDRESS=${DNSMASQ_RELAY_ADDRESS:-'DNSMASQ_RELAY_ADDRESS'}

# Contains all the tags set during the DHCP transaction, separated by spaces
DNSMASQ_TAGS=${DNSMASQ_TAGS:-'DNSMASQ_TAGS'}

# This is set if --log-dhcp is in effect
DNSMASQ_LOG_DHCP=${DNSMASQ_LOG_DHCP:-'DNSMASQ_LOG_DHCP'}

# If the host provided a client-id
DNSMASQ_CLIENT_ID=${DNSMASQ_CLIENT_ID:-'DNSMASQ_CLIENT_ID'}

# If a DHCP relay-agent added any of these options
DNSMASQ_CIRCUIT_ID=${DNSMASQ_CIRCUIT_ID:-'DNSMASQ_CIRCUIT_ID'}
DNSMASQ_SUBSCRIBER_ID=${DNSMASQ_SUBSCRIBER_ID:-'DNSMASQ_SUBSCRIBER_ID'}
DNSMASQ_REMOTE_ID=${DNSMASQ_REMOTE_ID:-'DNSMASQ_REMOTE_ID'}

# If the client provides vendor-class
DNSMASQ_VENDOR_CLASS=${DNSMASQ_VENDOR_CLASS:-'DNSMASQ_VENDOR_CLASS'}

# a string containing the decimal values in the Parameter Request List option,
# comma separated, if the parameter request list option is provided by the
# client.
DNSMASQ_REQUESTED_OPTIONS=${DNSMASQ_REQUESTED_OPTIONS:-'DNSMASQ_REQUESTED_OPTIONS'}

# If the client provides user-classes
#DNSMASQ_USER_CLASS0=${DNSMASQ_USER_CLASS0:-'DNSMASQ_USER_CLASS0'}
#DNSMASQ_USER_CLASS1=${DNSMASQ_USER_CLASS0:-'DNSMASQ_USER_CLASS1'}
#...etc

generate_post_data()
{
    echo ""
    echo "{\"ACTION\": \"$action\",\"HOSTMAC\":\"$mac\",\"IP\":\"$ip\",\"HOSTNAME\":\"$hostname\",\"DNSMASQ_LEASE_EXPIRES\":\"$DNSMASQ_LEASE_EXPIRES\",\"DNSMASQ_LEASE_LENGTH\":\"$DNSMASQ_LEASE_LENGTH\",\"DNSMASQ_DOMAIN\":\"$DNSMASQ_DOMAIN\",\"DNSMASQ_SUPPLIED_HOSTNAME\":\"$DNSMASQ_SUPPLIED_HOSTNAME\",\"DNSMASQ_TIME_REMAINING\":\"$DNSMASQ_TIME_REMAINING\",\"DNSMASQ_OLD_HOSTNAME\":\"$DNSMASQ_OLD_HOSTNAME\",\"DNSMASQ_INTERFACE\":\"$DNSMASQ_INTERFACE\",\"DNSMASQ_RELAY_ADDRESS\":\"$DNSMASQ_RELAY_ADDRESS\",\"DNSMASQ_TAGS\":\"$DNSMASQ_TAGS\",\"DNSMASQ_LOG_DHCP\":\"$DNSMASQ_LOG_DHCP\",\"DNSMASQ_CLIENT_ID\":\"$DNSMASQ_CLIENT_ID\",\"DNSMASQ_CIRCUIT_ID\":\"$DNSMASQ_CIRCUIT_ID\",\"DNSMASQ_SUBSCRIBER_ID\":\"$DNSMASQ_SUBSCRIBER_ID\",\"DNSMASQ_REMOTE_ID\":\"$DNSMASQ_REMOTE_ID\",\"DNSMASQ_VENDOR_CLASS\":\"$DNSMASQ_VENDOR_CLASS\",\"DNSMASQ_REQUESTED_OPTIONS\":\"$DNSMASQ_REQUESTED_OPTIONS\"}"
}

curl -i \
-H "Accept: application/json" \
-H "Content-Type:application/json" \
-H "X-CSRF-TOKEN:LGri4hy2pGlx9wVpVvVqTHRwwavZVn2vYu2PS4a2" \
-X POST --data "$(generate_post_data)" "http://$destination/api/dnsmasq/events"
