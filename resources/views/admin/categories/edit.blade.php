@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                        <div class="block">
                            <div class="block-body">
                                <form action="{{ route('categories.update', $category)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input
                                            type="text"
                                            name="name"
                                            value="{{  old('name' , $category->name) }}"
                                            placeholder="Enter Category Name"
                                            class="form-control @error('name') is-invalid @enderror">

                                        @error('name')
                                           <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
