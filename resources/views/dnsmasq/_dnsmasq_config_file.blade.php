            @if($section == 'collapsalbe-view-of-dnsmasq-conf-file')
            <div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse show">
            @else
            <div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse">
            @endif
                <div class="col">

                    <div class="row">
                        <div class="col">
<small><pre>
{{ $server_config_file }}
</pre></small>
                        </div>
                        <div class="col">
                            <div class="btn-toolbar" role="toolbar" aria-label="DNSMASQ Config File Controls">
                                <div class="btn-group" role="group" aria-label="dnsmasq config controls">

                                    <a href="{{route('files.index')}}?load=dhcp_configs/dnsmasq.conf" class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-edit"></i>
                                        Edit Config
                                    </a>

                                    <form method="POST" action="{{ route('dnsmasq.reset') }}">
                                        @method('PATCH')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-sync"></i> Reset
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
