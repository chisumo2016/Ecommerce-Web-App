@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                   <h3>Customer Name : {{ $data->name }}</h3>
                   <h3>Customer Address : {{ $data->shipping_address }}</h3>
                   <h3>Customer Phone : {{ $data->name }}</h3>
                   <h2>Product Title : {{ $data->product->name }}</h2>
                   <h2>Product Price : {{ $data->product->price }}</h2>

                    <img src="{{  asset('storage/products/' .$data->product->image ) }}" alt="" height="250" width="250">

                </div>

            </div>
        </div>
    </section>
@endsection

{{--"/storage/products/{{ $data->product->image }}--}}

{{--<img src=" {{ asset('storage/products/' . $data->product->image) }}" alt="">--}}
{{--<img src="storage/products/{{$data->product->image}}" alt="" height="250" width="250">--}}
