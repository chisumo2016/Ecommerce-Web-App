<!DOCTYPE html>
<html>
<head>
    @include('admin.partials._head')
</head>
<body>
@include('admin.partials._header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.partials._sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        @include('admin.partials._page-header')
        @yield('admin')
        @include('admin.partials._footer')
    </div>
</div>
<!-- JavaScript files-->
@include('admin.partials._script')
</body>
</html>
