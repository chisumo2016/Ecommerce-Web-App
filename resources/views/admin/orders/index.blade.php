@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="block margin-bottom-sm">
                        <div class="title"><strong>Orders</strong></div>
                        <a href="#" class="btn btn-primary float-right">
                            Add Orders
                        </a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Product Title</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th>{{ $order->name }}</th>
                                        <td>{{ $order->shipping_address }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->product->price }}</td>
                                        <td>
                                            @if($order->product->image)
                                                <img src="{{ asset('storage/' . $order->product->image) }}" alt="" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
