@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-5">

        <div class="col">

            <div class="row">
                <div class="col font-italic" style="font-size:.85em;">
                    @if($container['State']['Running'])

                    <span class="fas fa-radiation-alt fa-spin text-success" style="font-size:1.25em;"></span>
                    <span class="text-success">Dnsmasq has been running since
                        <a-moment
                            start="{{ $container['State']['StartedAt'] }}"
                            :calendar="true"
                        ></a-moment>
                    </span>

                    @else

                    <span class="fas fa-radiation-alt text-secondary" style="font-size:1.25em;"></span>
                    <span class="text-dark">Dnsmasq has not been running since
                        <a-moment
                            start="{{ $container['State']['FinishedAt'] }}"
                            :calendar="true"
                        ></a-moment>
                    </span>

                    @endif

                    <div class="btn-toolbar float-right" role="toolbar" aria-label="DNSMASQ Container Controls">

                        <div class="btn-group" role="group" aria-label="container power controls">
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="start">
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-play"></i> Start
                                </button>
                            </form>
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="stop">
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-square"></i> Stop
                                </button>
                            </form>
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="restart">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-sync"></i> Restart
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
















            <div class="row mt-4 mb-5">
                <div class="col d-flex justify-content-center">
                    <div class="btn-toolbar" role="toolbar" aria-label="DNSMASQ Container Controls">

                        <div class="btn-group" role="group" aria-label="dnsmasq config controls">
                            <button
                                class="btn btn-sm btn-outline-dark"
                                data-target="#collapsalbe-view-of-dnsmasq-conf-file"
                                data-toggle="collapse"
                            >
                                <i class="fas fa-eye"></i>
                                View Config
                            </button>

                            <a href="{{route('files.index')}}?load=dhcp_configs/dnsmasq.conf" class="btn btn-sm btn-outline-dark">
                                <i class="fas fa-edit"></i>
                                Edit Config
                            </a>

                            <form method="POST" action="{{ route('dnsmasq.reset') }}">
                                @method('PATCH')
                                @csrf
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="fas fa-sync"></i> Reset
                                </button>
                            </form>


                        </div>

                        <div class="btn-group ml-1" role="group" aria-label="dnsmasq leases controls">
                            <button class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#dnsmasq-leases-modal">
                                <i class="fas fa-tags"></i>
                                @if ($number_of_leases == 1)
                                {{ $number_of_leases }} lease
                                @else
                                {{ $number_of_leases }} leases
                                @endif
                            </button>

                            <button class="btn btn-sm btn-outline-dark" data-toggle="collapse" data-target="#collapsable-list-of-config-files">
                                <i class="fas fa-cogs"></i>
                                Booting With <span class="font-weight-bold">{{ count($config_files) }}</span> Files
                            </button>

                            <button class="btn btn-sm btn-outline-dark" data-toggle="collapse" data-target="#collapsable-list-of-tftp_files">
                                <i class="fas fa-cogs"></i>
                                <span class="font-weight-bold">{{ count($tftp_files) }}</span> TFTP Files
                            </button>

                            <button class="btn btn-sm btn-outline-dark" data-toggle="collapse" data-target="#collapsable-list-of-imports">
                                <i class="fas fa-file-import"></i>
                                {{ count($imports) }} Files Uploaded
                            </button>
                        </div>

                    </div>

                </div>
            </div>

            <div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse">
                <div class="col">
<small><pre>
{{ $server_config_file }}
</pre></small>
                </div>
            </div>

            <div id="collapsable-list-of-config-files" class="row collapse">
                <div class="col">

                    <ul class="list-group text-dark">
                        @foreach($config_files as $file)
                            <li class="list-group-item">
                                <a href="/files?load={{$file}}">
                                    {{ \Illuminate\Support\Str::after($file,'dhcp_configs/dnsmasq.d/') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div id="collapsable-list-of-tftp_files" class="row collapse">
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <ul class="list-group text-dark">
                                @foreach($tftp_files as $file)
                                <li class="list-group-item" style="font-size:.85rem">
                                    {{ \Illuminate\Support\Str::after($file,'tftp_files/') }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div id="collapsable-list-of-imports" class="row collapse">
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <ul class="list-group text-dark">
                                @foreach($imports as $file)
                                    <li class="list-group-item" style="font-size:.85rem">
                                        <a href="/files?load={{$file}}">
                                            {{ \Illuminate\Support\Str::after($file,'imports/') }}
                                        </a>

                                        <div class="btn-group btn-group-sm float-right" role="group" aria-label="File Controls">
                                            <form method="POST" action="{{ route('files.destroy') }}?load={{ $file }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-secondary mr-2" type="submit">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('imports.update') }}?load={{ $file }}">
                                                @method('PATCH')
                                                @csrf
                                                <button class="btn btn-sm btn-secondary" type="submit">
                                                    <i class="fas fa-file-import"></i> Import
                                                </button>
                                            </form>

                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <file_uploader form-action="{{ route('imports.store') }}"></file_uploader>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@include('dnsmasq._leases_modal')

</div>

@endsection
