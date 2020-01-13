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
