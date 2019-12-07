@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-5">

        <div class="col-2">
            <ul class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item bg-light">Home</a>
                <a href="{{ route('dnsmasq.index') }}" class="list-group-item bg-light">Dnsmasq</a>
                <a href="{{ route('horizon.index') }}" class="list-group-item bg-light">Horizon</a>
                <a href="/traefik" class="list-group-item bg-light">Traefik</a>
                <a href="/dozzle" class="list-group-item bg-light">Dozzle</a>
                <a href="/portainer" class="list-group-item bg-light">Portainer</a>
            </ul>
        </div>

        <div class="col">

            <div class="row mb-5">
                <div class="col">

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


                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button class="btn btn-info" data-toggle="modal" data-target="#dnsmasq-leases-modal">Leases</button>
                    @include('dnsmasq._leases_modal')
                </div>
                <div class="col">
                    <a href="{{route('files.index')}}?load=dhcp_configs/dnsmasq.conf" class="btn btn-warning">Edit File</a>
                    <button class="btn btn-info" data-toggle="modal" data-target="#server-config-file-modal">Server Config File</button>
                    @include('dnsmasq._server_config_file_modal')
                </div>
                <div class="col">
                    <button class="btn btn-info" data-toggle="modal" data-target="#config-files-modal">Config Files</button>
                    @include('dnsmasq._config_files_modal')
                </div>
            </div>


        </div>
    </div>



    <div class="row">
        <div class="col text-info d-none">
            {{$server_config_file}}
        </div>
    </div>
    <div class="row">
        <div class="col text-danger d-none">
            {{$leases_file}}
        </div>
    </div>
    <div class="row">
        <div class="col text-success d-none">
            {{count($config_files)}} Files
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
<hr>
            <iframe
                src="{{ config('app.url') }}/dozzle/container/{{ Illuminate\Support\Str::limit($container['Id'], 12, '') }}"
                class="border-0 d-none"
                width="100%"
                height="200"
            >
            </iframe>

        </div>
    </div>

</div>

@endsection
