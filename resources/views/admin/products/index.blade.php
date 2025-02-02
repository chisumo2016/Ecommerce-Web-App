@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">

                    <div class="block margin-bottom-sm">
                            <div class="title"><strong>View Products</strong></div>
                        <a href="{{ route('products.create') }}" class="btn btn-primary float-right">
                            Add Product
                        </a>

                        <div class="search-panel">
                            <div class="col-md-6">
                                <form action="{{ route('search') }}" method="get">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input
                                                type="search"
                                                name="search"
                                                class="form-control @error('search') is-invalid @enderror"
                                                placeholder="What are you searching for..."
                                                value="{{ old('search') }}">

                                            @error('search')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Action</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products  as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{!! Str::limit($product->description , 50) !!}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No Image Available
                                        @endif
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                     <td>
                                         <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                         <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                         </form>
                                     </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $products->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
