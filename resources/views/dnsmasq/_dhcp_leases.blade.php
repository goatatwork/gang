            @if($section == 'collapsalbe-view-of-dhcp-leases')
            <div id="collapsalbe-view-of-dhcp-leases" class="row collapse justify-content-center show">
            @else
            <div id="collapsalbe-view-of-dhcp-leases" class="row collapse justify-content-center">
            @endif
                <div class="col-10">

                    <h4 class="mb-3">Active DHCP Leases</h4>

                    <div class="row">
                        <div class="col">

<small><pre>
{{ $leases_file }}
</pre></small>

                        </div>
                    </div>

                </div>
            </div>
