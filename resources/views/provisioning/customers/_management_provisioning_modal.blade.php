<div class="modal fade" id="management-provisioning-modal-{{ $customer->id}}" tabindex="-1" role="dialog" aria-labelledby="management-provisioning-modal-{{ $customer->id}}-Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-dark" id="management-provisioning-modal-{{ $customer->id}}-Label">
                    Provisioning {{ $customer->poc_name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if($customer->provisioned)
            <form method="POST" action="{{ route('customers.unprovision', ['customer' => $customer]) }}">
                @csrf
                @method('DELETE')

            @else
            <form method="POST" action="{{ route('customers.provision', ['customer' => $customer]) }}">
                @csrf
                @method('POST')
            @endif

                <div class="modal-body text-dark">

                    <div class="form-group">
                        <lable for="template-{{$customer->id}}">Template</lable>
                        @if($customer->provisioned)
                        <input id="template-input-{{$customer->id}}"
                            type="text"
                            name="template"
                            class="form-control"
                            value="zhone_management"
                            aria-describedby="template-{{$customer->id}}"
                            value="{{ $customer->getMedia('dhcp_configs')->last()->getCustomProperty('template') }}"
                        >
                        @else
                        <input id="template-input-{{$customer->id}}"
                            type="text"
                            name="template"
                            class="form-control"
                            value="zhone_management"
                            aria-describedby="template-{{$customer->id}}"
                        >
                        @endif
                    </div>

                    <div class="form-group">
                        <lable for="ip-{{$customer->id}}">IP Address</lable>
                        @if($customer->provisioned)
                        <input id="ip-input-{{$customer->id}}"
                            name="ip"
                            type="text"
                            class="form-control"
                            aria-describedby="ip-{{$customer->id}}"
                            value="{{ $customer->getMedia('dhcp_configs')->last()->getCustomProperty('ip') }}"
                        >
                        @else
                        <input id="ip-input-{{$customer->id}}"
                            name="ip"
                            type="text"
                            class="form-control"
                            aria-describedby="ip-{{$customer->id}}"
                        >
                        @endif
                    </div>

                    <div class="form-group">
                        <lable for="subscriber_id-{{$customer->id}}">Subscriber ID</lable>
                        @if($customer->provisioned)
                        <input id="subscriber_id-input-{{$customer->id}}"
                            type="text"
                            name="subscriber_id"
                            class="form-control"
                            value="testSubsrbrId"
                            aria-describedby="subscriber_id-{{$customer->id}}"
                            value="{{ $customer->getMedia('dhcp_configs')->last()->getCustomProperty('subscriber_id') }}"
                        >
                        @else
                        <input id="subscriber_id-input-{{$customer->id}}"
                            type="text"
                            name="subscriber_id"
                            class="form-control"
                            value="testSubsrbrId"
                            aria-describedby="subscriber_id-{{$customer->id}}"
                        >
                        @endif
                    </div>

                    <small>
                        provisioning
                    </small>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Provision that shit!</button>
                </div>

            </form>

        </div>
    </div>
</div>
