@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-5">

        @include('include.menu')

        <div class="col">

            <div class="row">
                <div class="col">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <img src="https://robohash.org/Dnsmasq.png?size=75x75&set=set3" alt="Dnsmasq">

                            @if($container['State']['Running'])

                            <span class="fas fa-radiation-alt fa-spin text-success" style="font-size:1.85em;"></span>
                            <span class="font-weight-bold">DHCP IS RUNNING...
                                and has been since {{ $container['State']['StartedAt'] }}
                            </span>

                            @else

                            <span class="fas fa-radiation-alt text-secondary" style="font-size:1.85em;"></span>
                            <span class="font-weight-bold">DHPC IS NOT RUNNING...
                                and has not been running since {{ $container['State']['FinishedAt'] }}
                            </span>

                            @endif

                        </li>

                        <li class="list-group-item">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#server-config-file-modal">view config file</button>
                            <a href="{{route('files.index')}}?load=dhcp_configs/dnsmasq.conf" class="btn btn-sm btn-warning">edit config file</a>
                            @include('dnsmasq._server_config_file_modal')
                        </li>

                        <li class="list-group-item">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#dnsmasq-leases-modal">Leases</button>
                            @include('dnsmasq._leases_modal')
                        </li>

                        <li class="list-group-item">
                            There are {{ count($config_files) }} config files.<br>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#config-files-modal">Config Files</button>
                            @include('dnsmasq._config_files_modal')
                        </li>

                        <li class="list-group-item">
                            There are {{ count($imports) }} imports.<br>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#imports-modal">Import Files</button>
                            @include('dnsmasq._imports_modal')
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
