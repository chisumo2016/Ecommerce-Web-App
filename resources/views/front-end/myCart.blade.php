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
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                                $value = 0;
                        ?>
                            @foreach($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->price }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $cart->product->image ) }}" alt="" width="150">
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>

                                <?php
                                    $value = $value + $cart->product->price;
                                ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center" style="width: 100%; text-align: center; margin-top: 20px;">
                    <h3>Total Value of Cart is ${{ $value }}</h3>
                </div>
            </div>
        </div>

    </section>
@endsection

