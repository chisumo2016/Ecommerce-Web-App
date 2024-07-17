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
                                    <th>Change Status</th>
                                    <th>Print PDF</th>

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
                                        <td>
                                            @if($order->status  == 'in progress')
                                                <span style="color: red">{{ $order->status }}</span>
                                            @elseif($order->status  == 'On the  way')
                                                <span style="color: blue">{{ $order->status }}</span>
                                            @else
                                                <span style="color: yellow">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('on.the.way', $order->id) }}" class="btn btn-primary ">On the way</a>
                                            <a href="{{ route('delivered', $order->id) }}" class="btn btn-success ">Delivered</a>
                                        </td>
                                          <td>
                                              <a href="{{ route('pdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>
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
    </section>
@endsection
