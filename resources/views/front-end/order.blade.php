@extends('front-end.layouts.app')

@section('master')
    <div class="container-fluid mt-4">
        <div class="row">

            <div class="col-lg-12">

                <div class="block margin-bottom-sm">
                    <div class="title"><strong>View Order</strong></div>


                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Delivery Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders  as $order)
                                <tr>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->product->price }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <img src="/products/{{ $order->product->image }}" alt="" height="200" width="200">
                                    </td>

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
