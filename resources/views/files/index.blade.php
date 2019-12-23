@extends('layouts.app')

@section('content')

<div class="container">

    <file_editor
        file-content="{{ $file }}"
        file-name="{{ $file_name }}"
        post-url="{{ route('files.store') }}?load={{$file_name}}"
    ></file_editor>

</div>

@endsection
