@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-5">

        <div class="col">

            <div class="row">
                <div class="col">

                    @include('dnsmasq._dnsmasq_container_controls')

                    @include('dnsmasq._running_since')

                </div>
            </div>

            <div class="row mt-5">
                <div class="col">

                </div>
            </div>

            @include('dnsmasq._dnsmasq_config_file')

            @include('dnsmasq._config_files')

            @include('dnsmasq._tftp_files')

            @include('dnsmasq._import_files')

            @include('dnsmasq._dhcp_leases')

        </div>
    </div>

@include('dnsmasq._leases_modal')

</div>

@endsection
