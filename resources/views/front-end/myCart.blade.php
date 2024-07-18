@extends('front-end.layouts.master')

@section('master')
    <section class="shop_section layout_padding">
        <div class="container">

            <div class="row">

                <div class="col-md-6">
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

                    <div class="text-center" style="width: 100%; text-align: center; margin-top: 20px;">
                        <h3>Total Value of Cart is ${{ $value }}</h3>
                    </div>
                </div>

                <div class="col-md-5">
                    <form action="{{ route('confirm.order') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Receiver Name</label>
                            <input type="text" placeholder="Name"  name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Receiver Address</label>
                            <textarea name="address" id="" cols="30" rows="10" class="form-control">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Phone</label>
                            <input type="text" name="phone" placeholder="Enter Your Telephone Number" class="form-control" value="{{ Auth::user()->phone }}">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Cash On Delivery" class="btn btn-primary">

                            <a href="{{ route('home.stripe', $value) }}" class="btn btn-success">Pay Using Card</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

 6

