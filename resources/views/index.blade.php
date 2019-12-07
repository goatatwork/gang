@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
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
            xxxxxx
        </div>

        <div class="col">
            <back_channel></back_channel>
        </div>
    </div>

</div>

@endsection
