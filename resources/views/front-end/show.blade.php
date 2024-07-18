@extends('front-end.layouts.master')

@section('master')
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Product Details
                </h2>
            </div>
            <div class="row">

                    <div class="col-md-12">
                        <div class="box">
                            <div class="img-box">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" >
                                @else
                                    No Image
                                @endif
                            </div>
                            <div class="detail-box " style="padding: 15px;">
                                <h6>{{ $product->name }}</h6>
                                <h6>Price<span> ${{ $product->price }}</span></h6>
                            </div>

                            <div class="detail-box" style="padding: 15px;">
                                <h6>Category: {{ $product->category->name }}</h6>
                                <h6>Available Quantity<span>{{ $product->quantity }}</span></h6>
                            </div>

                            <div class="detail-box" style="padding: 15px;" >

                                <h6>Description :{{ $product->description }}</span></h6>
                            </div>

                            <div class="detail-box" style="padding: 15px;" >

                                <a href="{{ route('add.cart', $product) }}" class="btn btn-success">Add To Cart</a>
                            </div>
                        </div>
                    </div>
            </div>
{{--            <div class="btn-box">--}}
{{--                <a href="">--}}
{{--                    View All Products--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </section>
@endsection

