@extends('front-end.layouts.master')

@section('master')
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Latest Products
                </h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->price }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $cart->product->image ) }}" alt="" width="150">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection

