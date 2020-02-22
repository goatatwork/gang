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

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="d-none">name</th>
                                <th>poc_name</th>
                                <th>poc_email</th>
                                <th>phone1</th>
                                <th class="d-none">phone2</th>
                                <th class="d-none">address1</th>
                                <th class="d-none">address2</th>
                                <th class="d-none">city</th>
                                <th>state</th>
                                <th class="d-none">zip</th>
                                <th class="d-none">notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers->items() as $customer)
                            <tr>
                                <td class="d-none">{{$customer->name}}</td>
                                <td>{{$customer->poc_name}}</td>
                                <td>{{$customer->poc_email}}</td>
                                <td>{{$customer->phone1}}</td>
                                <td class="d-none">{{$customer->phone2}}</td>
                                <td class="d-none">{{$customer->address1}}</td>
                                <td class="d-none">{{$customer->address2}}</td>
                                <td class="d-none">{{$customer->city}}</td>
                                <td>{{$customer->state}}</td>
                                <td class="d-none">{{$customer->zip}}</td>
                                <td class="d-none">{{$customer->notes}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            {{ $customers->links('provisioning.customers._pagination') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
