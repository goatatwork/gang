@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            <div class="row mt-5 mb-5">

                <div class="col text-center">

                    0000

                </div>

                <div class="col text-center">

                    0001

                </div>

            </div>

            <div class="row justify-content-center">
                <div class="col-11">


                    <div class="media mb-2 bg-light">
                        <span class="fas fa-map-marker mr-3" style="font-size: 2rem;"></span>
                        <div class="media-body">

                            <div class="row">
                                <div class="col">

                                    <span class="h4 mt-0">{{$customer->name}}</span>

                                    <address style="font-size:.85rem;">
                                        <a href="#address-{{$customer->id}}"
                                            data-toggle="collapse"
                                            class="text-dark"
                                            role="button"
                                        >
                                            [address]
                                        </a>

                                        <br>

                                        <span id="address-{{$customer->id}}" class="collapse show">
                                            @if ($customer->poc_name != $customer->name) {{ $customer->poc_name }} <br> @endif
                                            @if ($customer->address1) {{ $customer->address1 }} <br> @endif
                                            {{ $customer->city }}, {{ $customer->state }}  {{ $customer->zip }} <br>
                                            @if ($customer->phone1) {{ $customer->phone1 }} <br> @endif
                                            @if ($customer->phone2) {{ $customer->phone2 }} <br> @endif
                                            @if ($customer->poc_email) {{ $customer->poc_email }} <br> @endif
                                        </span>
                                    </address>

                                </div>
                                <div class="col">
                                    @if($customer->provisioned)
                                    <span class="far fa-address-card mt-5 text-success" style="font-size: 3rem;"></span>
                                    @else
                                    <span class="far fa-address-card mt-5 text-secondary" style="font-size: 3rem;"></span>
                                    @endif
                                </div>
                                <div class="col pt-3">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#management-provisioning-modal-{{ $customer->id }}">
                                        Provision
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @include('provisioning.customers._management_provisioning_modal')

</div>

@endsection
