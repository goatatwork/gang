@if($section == 'collapsable-list-of-imports')
<div id="collapsable-list-of-imports" class="row collapse justify-content-center show">
@else
<div id="collapsable-list-of-imports" class="row collapse justify-content-center">
@endif
    <div class="col-10">

        <h4 class="mb-3">Import Files</h4>

        <div class="row mb-3">
            <div class="col">
                <p class="pr-5">
                    This is a staging area for adding files to the server. Files can be uploaded here and then processed into their final destinations which will be in the <span class="font-weight-bold">Service Files</span> area or in the <span class="font-weight-bold">TFTP Files</span> area. Files here will <span class="font-weight-bold">NOT</span> be read when Dnsmasq starts.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ul class="list-group text-dark">
                    @foreach($imports as $file)
                        <li class="list-group-item" style="font-size:.85rem">
                            <a href="/files?load={{$file}}">
                                {{ \Illuminate\Support\Str::after($file,'imports/') }}
                            </a>

                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="File Controls">
                                <form method="POST" action="{{ route('imports.update') }}?load={{ $file }}">
                                    @method('PATCH')
                                    @csrf
                                    <button class="btn btn-sm btn-dark" type="submit" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">
                                        <i class="fas fa-file-import"></i> Import
                                    </button>
                                </form>

                                <a href="/files/download?load={{$file}}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-download"></i> Download
                                </a>

                                <button class="btn btn-sm btn-dark mr-2" data-toggle="modal" data-target="#delete-importfile-{{$loop->iteration}}" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>

                            <div class="modal fade"
                                id="delete-importfile-{{$loop->iteration}}"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="delete-importfile-{{$loop->iteration}}-label"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="delete-importfile-{{$loop->iteration}}-label">Confirm To Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form method="POST" action="{{ route('files.destroy') }}?load={{ $file }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-dark" type="submit">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <file_uploader form-action="{{ route('imports.store') }}"></file_uploader>
            </div>
        </div>

    </div>
</div>
