@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        @include('include.menu')

        <div class="col">
            <back_channel></back_channel>
        </div>
    </div>

</div>

@endsection
