@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            home
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <a href="{{ route('dnsmasq.index') }}" class="list-group-item bg-dark text-light">Dnsmasq</a>
                <a href="{{ route('horizon.index') }}" class="list-group-item bg-dark text-light">Horizon</a>
            </ul>
        </div>
    </div>

</div>

@endsection
