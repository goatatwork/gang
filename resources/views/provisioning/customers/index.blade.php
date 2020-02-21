@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            <div class="row mt-5 mb-5">

                <div class="col text-center">

                    1111

                </div>

                <div class="col text-center">

                    0000

                </div>

            </div>

            <div class="row justify-content-center">
                <div class="col-10">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>poc_name</th>
                                <th>poc_email</th>
                                <th>phone1</th>
                                <th>phone2</th>
                                <th>address1</th>
                                <th>address2</th>
                                <th>city</th>
                                <th>state</th>
                                <th>zip</th>
                                <th>notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{$name}}</td>
                                <td>{{$poc_name}}</td>
                                <td>{{$poc_email}}</td>
                                <td>{{$phone1}}</td>
                                <td>{{$phone2}}</td>
                                <td>{{$address1}}</td>
                                <td>{{$address2}}</td>
                                <td>{{$city}}</td>
                                <td>{{$state}}</td>
                                <td>{{$zip}}</td>
                                <td>{{$notes}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
