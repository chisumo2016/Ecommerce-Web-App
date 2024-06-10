
<!DOCTYPE html>
<html>

@include('front-end.partials._head')

<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('front-end.partials._header')
    <!-- end header section -->
    <!-- slider section -->
    @include('front-end.partials._slider')

    <!-- end slider section -->
</div>
<!-- end hero area -->

<!-- shop section -->

@yield('master')

<!-- end shop section -->

<!-- contact section -->

@include('front-end.partials._contact')
<br><br><br>

<!-- end contact section -->



<!-- info section -->



<!-- end info section -->


@include('front-end.partials._footer')
</body>

</html>
