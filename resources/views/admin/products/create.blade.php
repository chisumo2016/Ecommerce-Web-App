@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <!-- Breadcrumb-->
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">CREATE PRODUCT </li>
            </ul>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                        <div class="block">
                            <div class="block-body">
                                <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input
                                            type="text"
                                            name="name"
                                            placeholder="Enter Product Name"
                                            class="form-control @error('name') is-invalid @enderror">

                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea
                                            name="description"
                                            placeholder="Enter Description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            rows="4">{{ old('description') }}</textarea>

                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Upload File</label>
                                        <input
                                            type="file"
                                            name="image"
                                            class="form-control @error('file') is-invalid @enderror">

                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Quantity</label>
                                        <input
                                            type="number"
                                            name="quantity"
                                            placeholder="Enter Quantity"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity') }}">

                                        @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Price</label>
                                        <input
                                            type="number"
                                            name="price"
                                            placeholder="Enter Price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}"
                                            step="0.01">

                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Product Category</label>
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add Product" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
