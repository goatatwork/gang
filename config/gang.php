<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Local Docker Daemon Information
    |--------------------------------------------------------------------------
    |
    | The Docker API version provided by the docker daemon on the host
    |
    */

    'docker_api_version' => env('GANG_DOCKER_API_VERSION', '1.40'),

    /*
    |--------------------------------------------------------------------------
    | DHCP container name
    |--------------------------------------------------------------------------
    |
    | The name of the DHCP container
    |
    */

   'dhcp_container_name' => env('GANG_DHCP_CONTAINER_NAME', 'gang_dhcp'),

    /*
    |--------------------------------------------------------------------------
    | DHCP disk
    |--------------------------------------------------------------------------
    |
    | The disk to use to store DHCP files. The work will be done in the
    | dhcp_configs/ directory under this disk.
    |
    */

   'dhcp_default_disk' => env('GANG_DHCP_DEFAULT_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | DHCP config file
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the dnsmasq.conf file
    |
    */

   'dhcp_config_file_location' => env('GANG_DHCP_CONFIG_FILE_LOCATION','dhcp_configs/dnsmasq.conf'),

    /*
    |--------------------------------------------------------------------------
    | DHCP leases file
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the leases file
    |
    */

   'dhcp_leases_file_location' => env('GANG_DHCP_LEASES_FILE_LOCATION','dhcp_leases/dnsmasq.leases'),

    /*
    |--------------------------------------------------------------------------
    | DHCP service files
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the service (config) files
    | to boot with
    |
    */

   'dhcp_service_files_location' => env('GANG_DHCP_SERVICE_FILES_LOCATION', 'dhcp_configs/dnsmasq.d'),

    /*
    |--------------------------------------------------------------------------
    | DHCP tftp files
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the tftp files offered by
    | the dhcp server
    |
    */

   'dhcp_tftp_files_location' => env('GANG_DHCP_TFTP_FILES_LOCATION', 'tftp_files'),

    /*
    |--------------------------------------------------------------------------
    | Import files
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the directory used for
    | files to be uploaded to for the purposes of then importing them into
    | gang.
    |
    */

   'files_for_import_location' => env('GANG_FILES_FOR_IMPORT_LOCATION', 'imports'),

    /*
    |--------------------------------------------------------------------------
    | Customer Generated DHCP files
    |--------------------------------------------------------------------------
    |
    | The location (relative to the 'public' disk) of the directory used for
    | dhcp files to be written to when provisioning customers. I.E. the
    | directory MediaLibrary is operating in.
    |
    */

   'dhcp_generated_files_location' => env('GANG_DHCP_GENERATED_FILES_LOCATION', 'customer_files'),

    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    |
    | The timezone to operate in
    |
    */

    'timezone' => env('TZ', 'America/Chicago'),
];
