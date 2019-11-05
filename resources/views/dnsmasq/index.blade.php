@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col">

            @if($container['State']['Running'])

            <span class="fas fa-radiation-alt fa-spin text-success" style="font-size:1.85em;"></span>
            <span class="font-weight-bold">DHPC IS RUNNING...
                since {{ \Carbon\Carbon::create($container['State']['StartedAt'])->diffForHumans() }}
            </span>

            @else

            <span class="fas fa-radiation-alt text-secondary" style="font-size:1.85em;"></span>
            <span class="font-weight-bold">DHPC IS NOT RUNNING...
                since {{ \Carbon\Carbon::create($container['State']['FinishedAt'])->diffForHumans() }}
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
            <button class="btn btn-info" data-toggle="modal" data-target="#server-config-file-modal">Server Config File</button>
            @include('dnsmasq._server_config_file_modal')
        </div>
        <div class="col">
            <button class="btn btn-info" data-toggle="modal" data-target="#config-files-modal">Config Files</button>
            @include('dnsmasq._config_files_modal')
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

            <iframe
                src="{{ config('app.url') }}/dozzle/container/{{ Illuminate\Support\Str::limit($container['Id'], 12, '') }}"
                class="border-0"
                width="100%"
                height="200"
            >
            </iframe>

        </div>
    </div>

</div>

@endsection
