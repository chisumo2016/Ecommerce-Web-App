@extends('admin.layouts.master')

@section('admin')
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="col-lg-12">
                    <div class="block margin-bottom-sm">
                            <div class="title"><strong>Categories</strong></div>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary float-right">
                            Add Category
                        </a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                     <td>
                                         <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                         <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                         </form>
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
