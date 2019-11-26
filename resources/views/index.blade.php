@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <a href="{{ route('dnsmasq.index') }}" class="list-group-item bg-dark text-light">Dnsmasq</a>
                <a href="{{ route('horizon.index') }}" class="list-group-item bg-dark text-light">Horizon</a>
                <a href="/traefik" class="list-group-item bg-dark text-light">Traefik</a>
                <a href="/dozzle" class="list-group-item bg-dark text-light">Dozzle</a>
                <a href="/portainer" class="list-group-item bg-dark text-light">Portainer</a>
            </ul>
        </div>

        <div class="col-5">
            <file_viewer></file_viewer>
        </div>

        <div class="col-4">
            <back_channel></back_channel>
        </div>
    </div>

</div>

@endsection
