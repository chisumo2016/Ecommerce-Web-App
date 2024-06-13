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
                @foreach($products as  $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                                <div class="img-box">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        No Image
                                    @endif
                                </div>
                                <div class="detail-box">
                                    <h6>{{ $product->name }}</h6>
                                    <h6>Price<span> ${{ $product->price }}</span></h6>
                                </div>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('product.details', $product) }}" class="btn btn-success btn-sm m-1 ">Show Details</a>
                                <a href="{{ route('add.cart', $product) }}" class="btn btn-danger btn-sm  m-1">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-box">
                <a href="">
                    View All Products
                </a>
            </div>
        </div>
    </section>
@endsection
