            @if($section == 'collapsable-list-of-config-files')
            <div id="collapsable-list-of-config-files" class="row collapse show">
            @else
            <div id="collapsable-list-of-config-files" class="row collapse">
            @endif
                <div class="col">

                    <ul class="list-group text-dark">
                        @foreach($config_files as $file)
                            <li class="list-group-item">
                                <a href="/files?load={{$file}}">
                                    {{ \Illuminate\Support\Str::after($file,'dhcp_configs/dnsmasq.d/') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
