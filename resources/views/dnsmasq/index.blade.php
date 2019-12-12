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
                            <span class="fas fa-cog" style="font-size:1em;"></span>
                            <button data-target="#collapsalbe-view-of-dnsmasq-conf-file"
                                data-toggle="collapse"
                                class="btn btn-sm btn-success"
                            >
                                <span class="fas fa-eye"></span>
                                View the dnsmasq.conf file
                            </button>

                            OR

                            <a href="{{route('files.index')}}?load=dhcp_configs/dnsmasq.conf" class="btn btn-sm btn-primary">
                                Edit the dnsmasq.conf file
                            </a>

                            <div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse justify-content-center">
                                <div class="col-11 mt-5">
<small><pre>
{{ $server_config_file }}
</pre></small>
                                </div>
                            </div>

                        </li>

                        <li class="list-group-item">
                            <span class="fas fa-tags" style="font-size:1em;"></span>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#dnsmasq-leases-modal">
                                <span class="fas fa-tags" style="font-size:1em;"></span>
                                @if ($number_of_leases == 1)

                                {{ $number_of_leases }} lease

                                @else

                                {{ $number_of_leases }} leases

                                @endif

                            </button>
                            @include('dnsmasq._leases_modal')
                        </li>

                        <li class="list-group-item">
                            <span class="fas fa-cogs" style="font-size:1em;"></span>
                            I am reading {{ count($config_files) }} config files when I start.
                            <a href="#collapsable-list-of-config-files" data-toggle="collapse">Check them out</a>

                            <div id="collapsable-list-of-config-files" class="row collapse">
                                <div class="col mt-5">

                                    <ul class="list-group text-dark">
                                        @foreach($config_files as $file)
                                            <li class="list-group-item">
                                                <a href="/files?load={{$file}}">{{$file}}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <span class="fas fa-box" style="font-size:1em;"></span>
                            There are {{ count($imports) }} files available for import.
                            <a href="#collapsable-list-of-imports" data-toggle="collapse">Check them out</a>

                            <div id="collapsable-list-of-imports" class="row collapse">
                                <div class="col mt-5">

                                    <ul class="list-group text-dark">
                                        @foreach($imports as $file)
                                            <li class="list-group-item">
                                                <a href="/files?load={{$file}}">{{$file}}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
