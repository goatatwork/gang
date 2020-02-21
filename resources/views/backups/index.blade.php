@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-5 mb-5">

        <div class="col text-center">

            <ul class="list-unstyled">
                <li>
                    <span class="font-weight-bold">LAST BACKUP</span> {{ \Carbon\Carbon::parse($snapshots->first()['lastModified'])->diffForHumans() }}
                </li>
                <li>
                    <span class="font-weight-bold">OLDEST BACKUP</span> {{ \Carbon\Carbon::parse($snapshots->last()['lastModified'])->diffForHumans() }}
                </li>
            </ul>

        </div>

        <div class="col text-center">

            <div class="btn-toolbar" role="toolbar" aria-label="Database Snapshot Controls">
                <div class="btn-group" role="group" aria-label="Snapshot Controls">

                    <form class="form" method="POST" action="{{route('backups.create')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="backup_type" value="snapshot">
                        <button class="btn btn-outline-dark">
                            <i class="fas fa-camera-retro"></i> Take Snapshot
                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-10">

            <table class="table">
                <thead>
                    <tr>
                        <th>Created</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($snapshots as $snapshot)
                    <tr>
                        <td>{{ $snapshot['lastModified'] }}</td>
                        <td>{{ $snapshot['name'] }}</td>
                        <td>{{ $snapshot['size'] }}</td>
                        <td>
                            <div class="btn-group float-right" role="group" aria-label="Snapshot Controls">

                                <a href="{{ route('backups.load', ['snapshot' => $snapshot['name']]) }}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-clone"></i> Load
                                </a>

                                <a href="{{ route('backups.download', ['snapshot' => $snapshot['name']]) }}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-download"></i> Download
                                </a>

                                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#delete-snapshot-{{$loop->iteration}}" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @foreach($snapshots as $snapshot)
    <div id="delete-snapshot-{{$loop->iteration}}"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="delete-snapshot-label-{{$loop->iteration}}"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="delete-snapshot-label-{{$loop->iteration}}">Delete A Database Snapshot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you wish to delete {{ $snapshot['name'] }}?
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form class="form" method="POST" action="{{ route('backups.destroy', ['snapshot'=>$snapshot['name']]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="backup_type" value="snapshot">
                        <button class="btn btn-dark">
                            <i class="fas fa-trasg"></i> Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
