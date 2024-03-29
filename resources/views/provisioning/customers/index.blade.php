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

                    <div class="row">
                        <div class="col-auto">
                            <form action="{{ route('customers.index') }}" method="GET" class="form-inline">
                                <div class="form-group mr-5">
                                    <label for="sort-input">Sort By</label>
                                    <select id="sort-input" class="custom-select" name="sort">
                                        <option value="">Select One</option>
                                        <option value="name">name</option>
                                        <option value="-name">name desc</option>
                                        <option value="address1">address1</option>
                                        <option value="-address1">address1 desc</option>
                                    </select>
                                </div>

                                <div class="form-group mr-5">
                                    <label for="id-input">Find by</label>
                                    <input id="id-input" type="text" name="filter[id]" class="form-control" placeholder="ID..." value="">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-sm btn-dark" type="submit">Go</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @foreach($customers as $customer)
                                <div class="media mb-2 bg-light">
                                    <span class="fas fa-map-marker mr-3" style="font-size: 2rem;"></span>
                                    <div class="media-body">

                                        <div class="row">
                                            <div class="col">

                                                <span class="h4 mt-0">
                                                    <a href="{{ route('customers.show', ['customer' => $customer]) }}" class="text-dark">{{$customer->name}}</a>
                                                </span>

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
                                                @if($customer->provisioned)
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#management-provisioning-modal-{{ $customer->id }}">
                                                    Unprovision
                                                </button>
                                                @else
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#management-provisioning-modal-{{ $customer->id }}">
                                                    Provision
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            {{ $customers->links('provisioning.customers._pagination') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @foreach($customers as $customer)
        @include('provisioning.customers._management_provisioning_modal')
    @endforeach
</div>

@endsection
