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

                                <form method="POST" action="{{ route('files.destroy') }}?load={{ $file }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-dark" type="submit" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
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
