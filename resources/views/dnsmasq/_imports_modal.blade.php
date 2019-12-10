<div class="modal fade" id="imports-modal" tabindex="-1" role="dialog" aria-labelledby="imports-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-dark" id="imports-modalLabel">Imports</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-dark">

                {{ count($imports) }} Imports Files

                <ul class="list-group text-dark">
                    @foreach($imports as $file)
                        <li class="list-group-item">
                            <a href="/files?load={{$file}}">{{$file}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>

        </div>
    </div>
</div>
