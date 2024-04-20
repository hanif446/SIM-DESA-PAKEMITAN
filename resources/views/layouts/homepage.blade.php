<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <link rel="icon" type="image/png" href="{{asset('template2/img/logo-kab.png')}}">
    <title>WEBSITE DESA PAKEMITAN</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('template2/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/color-switcher.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/menu_sideslide.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/main.css')}}">    
    <link rel="stylesheet" href="{{asset('template2/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('template2/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  </head>
  
  <body>
    <!-- Header Section Start -->
    <header id="slider-area">   
      @include('layouts._homepage.navbar')

    </header>
    <!-- Header Section End --> 

    <!-- Call to Action Start -->
        @yield('content')
    <!-- Call to Action End -->


    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-arrow-up"></i>
    </a>
    

    <div id="loader">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div>    

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{asset('template2/js/jquery-min.js')}}"></script>
    <script src="{{asset('template2/js/popper.min.js')}}"></script>
    <script src="{{asset('template2/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template2/js/classie.js')}}"></script>
    <script src="{{asset('template2/js/jquery.mixitup.js')}}"></script>
    <script src="{{asset('template2/js/nivo-lightbox.js')}}"></script>
    <script src="{{asset('template2/js/owl.carousel.js')}}"></script>    
    <script src="{{asset('template2/js/jquery.stellar.min.js')}}"></script>    
    <script src="{{asset('template2/js/jquery.nav.js')}}"></script>    
    <script src="{{asset('template2/js/scrolling-nav.js')}}"></script>    
    <script src="{{asset('template2/js/jquery.easing.min.js')}}"></script>     
    <script src="{{asset('template2/js/wow.js')}}"></script> 
    <script src="{{asset('template2/js/jquery.vide.js')}}"></script>
    <script src="{{asset('template2/js/jquery.counterup.min.js')}}"></script>    
    <script src="{{asset('template2/js/jquery.magnific-popup.min.js')}}"></script>    
    <script src="{{asset('template2/js/waypoints.min.js')}}"></script>    
    <script src="{{asset('template2/js/form-validator.min.js')}}"></script>
    <script src="{{asset('template2/js/contact-form-script.js')}}"></script>   
    <script src="{{asset('template2/js/main.js')}}"></script>
    
  </body>
</html>