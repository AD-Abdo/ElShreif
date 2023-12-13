<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ URL::asset('assets/img/logo.png') }}" />
    <title>أكاديمية الشريف - @yield('title')</title>



    @include('admin.layouts.css')


</head>

<body class="layout-fixed" onload="">
    
    @include('admin.layouts.loading')
    @include('admin.layouts.header')

    <!-- Screen overlay start -->
    <div class="screen-overlay"></div>
    <!-- Screen overlay end -->

    @include('admin.layouts.sidebar')

    <div class="container-fluid">
        @include('admin.layouts.nav')

        <div class="main-container">


            @include('admin.layouts.nav_description')


            <div class="content-wrapper">

                @yield('content')

            </div>


        </div>

        @include('admin.layouts.footer')

    </div>

    @include('admin.layouts.js')

</body>

</html>
