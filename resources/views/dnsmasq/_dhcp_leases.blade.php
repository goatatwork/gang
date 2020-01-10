            @if($section == 'collapsalbe-view-of-dhcp-leases')
            <div id="collapsalbe-view-of-dhcp-leases" class="row collapse show">
            @else
            <div id="collapsalbe-view-of-dhcp-leases" class="row collapse">
            @endif
                <div class="col">

                    <div class="row">
                        <div class="col">
                            leases<br>
<small><pre>
{{ $leases_file }}
</pre></small>

                </div>
            </div>
