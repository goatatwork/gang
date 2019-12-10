@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        @include('include.menu')

        <div class="col">

            <div class="card shadow" style="width:15rem;">
                <img src="https://robohash.org/ReconBot.png?size=150x150&bgset=bg2" class="card-img-top" alt="reconbot">
                <div class="card-body text-center">
                    <a href="{{route('recon.index')}}" class="card-link">
                        RECONBOT
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
