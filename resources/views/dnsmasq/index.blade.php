@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-5">

        <div class="col">

            <div class="row mt-5 mb-5">

                <div class="col text-center">

                    @include('dnsmasq._running_since')

                </div>

                <div class="col text-center">

                    @include('dnsmasq._dnsmasq_container_controls')

                </div>

            </div>

            @if($section == '')
            <div class="row justify-content-center">
                <div class="col-10">
                    <h4 class="mb-3">Welcome! This is the DHCP server.</h4>

                    <p class="mb-2">In the menu on the left, you'll find the following sections:</p>

                    <ul class="list-unstyled mt-2">
                        <li class="mb-4 mt-3 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">Info:</span> This page, of course.
                        </li>

                        <li class="mb-4 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">Leases:</span> The current lease file showing all existing leases.
                            <a href="/dnsmasq/collapsalbe-view-of-dhcp-leases" class="ml-3 font-weight-bold text-dark">
                                go there <span class="fas fa-share"></span>
                            </a>
                        </li>

                        <li class="mb-4 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">Config:</span> This is the main configuration file for Dnsmasq.
                            <a href="/dnsmasq/collapsalbe-view-of-dnsmasq-conf-file" class="ml-3 font-weight-bold text-dark">
                                go there <span class="fas fa-share"></span>
                            </a>
                        </li>

                        <li class="mb-4 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">Service Files:</span> These are the files that are read whenever Dnsmasq boots up. These files can include any valid Dnsmasq configurations, or partial configurations.
                            <a href="/dnsmasq/collapsable-list-of-config-files" class="ml-3 font-weight-bold text-dark">
                                go there <span class="fas fa-share"></span>
                            </a>
                        </li>
                        <li class="mb-4 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">TFTP Files:</span> Dnsmasq is configured to serve as a TFTP server as well as it's primary role as the DHCP server. These are the files that are available via the TFTP service offered by Dnsmasq.
                            <a href="/dnsmasq/collapsable-list-of-tftp-files" class="ml-3 font-weight-bold text-dark">
                                go there <span class="fas fa-share"></span>
                            </a>
                        </li>
                        <li class="mb-4 pr-5">
                            <span class="font-weight-bold" style="font-size: 1.25em;">Import Files:</span> A staging area to upload files that will then be imported into either <a href="{{ route('dnsmasq.index', 'collapsable-list-of-config-files') }}" class="font-weight-bold text-dark">Service Files</a> or <a href="{{ route('dnsmasq.index', 'collapsable-list-of-tftp_files') }}" class="font-weight-bold text-dark">TFTP Files</a>.
                            <a href="/dnsmasq/collapsable-list-of-imports" class="ml-3 font-weight-bold text-dark">
                                go there <span class="fas fa-share"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

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
