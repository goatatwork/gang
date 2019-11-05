@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            home
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('dnsmasq.index') }}">Dnsmasq</a>
        </div>
    </div>

</div>

@endsection
