<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'CIAL Centre Interculturel Allemand')</title>
    <meta name="description" content="@yield('meta_description', 'Centre Interculturel Allemand (CIAL), centre de formation en langue allemande et centre d\'examen ÖSD accrédité à Sokodé, Togo.')">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/Logo_icone.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('logo/Logo_icone.png') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('logo/Logo_icone.png') }}?v=2">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/aos.css')}}">
    <link href="{{asset('vendors/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/css/style.css')}}">
    @stack('head')
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        @yield('content')
    </div>
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>
    <script src="{{asset('vendors/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery-ui.js')}}"></script>
    <script src="{{asset('vendors/js/popper.min.js')}}"></script>
    <script src="{{asset('vendors/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('vendors/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('vendors/js/aos.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <script src="{{asset('vendors/js/main.js')}}"></script>
    @stack('scripts')
</body>
</html>
