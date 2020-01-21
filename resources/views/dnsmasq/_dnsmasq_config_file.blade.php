@if($section == 'collapsalbe-view-of-dnsmasq-conf-file')
<div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse justify-content-center show">
@else
<div id="collapsalbe-view-of-dnsmasq-conf-file" class="row collapse justify-content-center">
@endif
    <div class="col-10">

        <h4 class="mb-3">Dnsmasq Configuration File</h4>

        <div class="row mb-3">
            <div class="col">
                <p class="pr-5">
                    This is the main configuration file for Dnsmasq. It is typically named <span class="font-italic">dnsmasq.conf</span>. Any valid configuration options can be placed in this file. Valid configuration options can be found <a href="http://www.thekelleys.org.uk/dnsmasq/docs/dnsmasq-man.html" target="_blank">here</a>.
                </p>
            </div>
        </div>

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
                                <i class="fas fa-sync"></i> Reset To Defaults
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
