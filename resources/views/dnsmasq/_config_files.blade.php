@if($section == 'collapsable-list-of-config-files')
<div id="collapsable-list-of-config-files" class="row collapse justify-content-center show">
@else
<div id="collapsable-list-of-config-files" class="row collapse justify-content-center">
@endif
    <div class="col-10">

        <h4 class="mb-3">DHCP Service Files</h4>

        <div class="row mb-3">
            <div class="col">
                <p class="pr-5">
                    These are the files that are read whenever Dnsmasq boots up. These files can include any valid Dnsmasq configurations, or partial configurations. Valid configuration options can be found <a href="http://www.thekelleys.org.uk/dnsmasq/docs/dnsmasq-man.html" target="_blank">here</a>. Files are added to the server by first uploading them using the <a href="/dnsmasq/collapsable-list-of-imports" class="font-weight-bold text-dark">Import Files</a> page.
                </p>
            </div>
        </div>

        <ul class="list-group text-dark">
            @foreach($config_files as $file)
                <li class="list-group-item" style="font-size:.85rem">

                    {{ \Illuminate\Support\Str::after($file,'dhcp_configs/dnsmasq.d/') }}

                    <div class="btn-group float-right" role="group" aria-label="File Controls">
                        <a href="/files?load={{$file}}" class="btn btn-sm btn-dark">
                            <i class="fas fa-edit"></i> Edit
                        </a>

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
</div>
