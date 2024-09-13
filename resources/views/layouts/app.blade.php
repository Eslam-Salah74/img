<!DOCTYPE html>
<html lang="en" dir="rtl">

<!--!--------------- Header Start -->
@include('layouts.header')
<!--!--------------- Header End -->

<!-- <div id="pills-home_1" class="tab-content d-block container-xxl w-100"></div> -->

<body>

    <!-- Spinner Start -->

    <!-- Spinner End -->

        <!--!--------------- Navbar Start -->
        @include('layouts.navbar')
    <!--!--------------- Navbar End -->

    @yield('content')

    <!--~-------------- reviews End -->
    <!--//-------------- Footer Start -->

    <!--//-------------- Footer Start -->
        @include('layouts.footer')
    <!--//-------------- Footer End -->

    <!-- end Back to Top -->
    <!--//-------------- Scripts Start -->
    @include('layouts.scripts')
    <!--//-------------- Scripts End -->


</body>

</html>