<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="Kost Kita, cari kos di Kost Kita, aplikasi pencari kos">
    <meta property="og:image" content="@yield('image') ">
    <meta name="author" content="Arfiyan Wahyu Pratama">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="{{asset('assets/images/logo/papikos_logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo/papikos_logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    {{-- CSS --}}
    @include('layouts.front.css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.front.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('layouts.front.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.front.footer')
    <!-- END: Footer-->


    {{-- Scripts --}}
    @include('layouts.front.scripts')
</body>
<!-- END: Body-->

</html>