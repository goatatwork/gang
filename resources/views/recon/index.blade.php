@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-10 shadow">
            <reconbot action="{{ route('recon.scan') }}"></reconbot>
        </div>
    </div>

@error('ip')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

</div>

@endsection
