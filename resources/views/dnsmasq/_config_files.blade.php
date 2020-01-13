            @if($section == 'collapsable-list-of-config-files')
            <div id="collapsable-list-of-config-files" class="row collapse show">
            @else
            <div id="collapsable-list-of-config-files" class="row collapse">
            @endif
                <div class="col">

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
