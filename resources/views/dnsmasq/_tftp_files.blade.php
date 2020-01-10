            @if($section == 'collapsable-list-of-tftp_files')
            <div id="collapsable-list-of-tftp_files" class="row collapse show">
            @else
            <div id="collapsable-list-of-tftp_files" class="row collapse">
            @endif
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <ul class="list-group text-dark">
                                @foreach($tftp_files as $file)
                                <li class="list-group-item" style="font-size:.85rem">
                                    {{ \Illuminate\Support\Str::after($file,'tftp_files/') }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
