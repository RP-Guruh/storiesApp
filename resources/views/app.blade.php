<!DOCTYPE html>
<html lang="en">
<head>
  <title>StoriesApp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/user/fonts/icomoon/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/lightgallery.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/fonts/flaticon/font/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/swiper.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
</head>
<body>

    <div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    @include('partials.header')

    @yield('content')

    <div class="footer py-4">
        <div class="container-fluid text-center">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </div>
</div>

@include('partials.footer')
