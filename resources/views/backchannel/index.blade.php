@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @foreach($messages as $message)
                <li class="list-group-item">
                    {{ $message->created_at }} | {{ $message->message }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
