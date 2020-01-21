@if($section == 'collapsable-list-of-tftp_files')
<div id="collapsable-list-of-tftp_files" class="row collapse justify-content-center show">
@else
<div id="collapsable-list-of-tftp_files" class="row collapse justify-content-center">
@endif
    <div class="col-10">

        <h4 class="mb-3">Files Available Via TFTP</h4>

        <div class="row mb-3">
            <div class="col">
                <p class="pr-5">
                    These are the files that are available via the TFTP service offered by Dnsmasq. Files are added to the server by first uploading them using the <a href="/dnsmasq/collapsable-list-of-imports" class="font-weight-bold text-dark">Import Files</a> page.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ul class="list-group text-dark">
                    @foreach($tftp_files as $file)
                    <li class="list-group-item" style="font-size:.85rem">

                        {{ \Illuminate\Support\Str::after($file,'tftp_files/') }}

                        <div class="btn-group btn-group-sm float-right" role="group" aria-label="File Controls">
                            <a href="/files/download?load={{$file}}" class="btn btn-sm btn-dark">
                                <i class="fas fa-download"></i> Download
                            </a>
                            <form method="POST" action="{{ route('files.destroy') }}?load={{ $file }}">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-dark mr-2" type="submit" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>

                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
