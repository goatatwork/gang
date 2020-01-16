@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                <back_channel_messages :messages="{{ $messages }}"></back_channel_messages>
            </ul>
        </div>
    </div>
</div>

@endsection
