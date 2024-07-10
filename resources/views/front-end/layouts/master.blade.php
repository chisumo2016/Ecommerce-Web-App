
<!DOCTYPE html>
<html>

@include('front-end.partials._head')

<body>

<div class="hero_area">
    <!-- header section strats -->
    @include('front-end.partials._header')
    <!-- end header section -->
    <!-- slider section -->
    @if(!Request::routeIs('product.details'))
    @include('front-end.partials._slider')
    @endif
    <!-- end slider section -->
</div>
<!-- end hero area -->

<!-- shop section -->

@yield('master')

<!-- end shop section -->

<!-- contact section -->
@if(!Request::routeIs('product.details','my.cart'))
@include('front-end.partials._contact')
@endif

<br><br><br>

<!-- end contact section -->



<!-- info section -->



<!-- end info section -->


@include('front-end.partials._footer')
</body>

</html>
