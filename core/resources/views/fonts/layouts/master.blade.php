<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$general->web_title}} @yield('site') </title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fontend_logo/icon.png')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/bootstrap.min.css')}}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/animate.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/owl.carousel.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/magnific-popup.css')}}">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front_assets/css/responsive.css')}}">

    <link href="{{url('/')}}/assets/front_assets/colors/base-color.php?color={{$general->theme}}" rel="stylesheet">
    <!-- responsive -->
    <script src="{{url('/')}}/assets/admin_assets/new.fontawesome.js " type="text/javascript"></script>
    @yield('style')
</head>

<body>

<!-- header-area start -->
<header class="header-area" style="background: url({{asset('assets/images/fontend_slide/'.$silder->image)}}); background-size: cover ; background-position:center;" id="home">
    <!-- navbar area start -->
    <nav class="navbar-area" style="background-color:transparent!important; ">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <a href="{{url('/')}}" class="logo">
                        <img src="{{asset('assets/images/fontend_logo/logo.png')}}" style="max-width: 240px; max-height: 54px; margin-top: 30px;" alt="Logo Image Will Be Here">
                    </a>
                </div>
                <div class="col-md-9 col-sm-6 col-xs-6">
                    <div class="responsive-menu"></div>
                    <ul id="main-menu">

                        @guest
                            <li><a href="#">Home</a></li>
                            <li><a href="#about">About us</a></li>
                            <li><a href="#service">Service</a></li>

                            <li><a href="#team">Team</a></li>

                            <li><a href="#blog">Blog</a></li>
                            <li><a href="#subscribe">Subscribe</a></li>
                            <li class="<?php echo request()->path() == 'news' ? 'menu-active dropdown open' : ''; ?>"><a href="{{route('news.index')}}"> News</a></li>
                            <li class="<?php echo request()->path() == 'contact' ? 'menu-active dropdown open' : ''; ?>"><a href="{{route('contact.index')}}"> Contact</a></li>
                        @else
                        <li><a href="{{url('/home')}}"> Dashboard</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- end nav bar -->

    <div class="slider-area-wrapper">
        <div class="single-slide-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>
                            <span>{{$silder->heading}}</span> <br>{{$silder->description}}
                        </h1>
                        <div class="btn-wrapper">
                            <a href="{{route('login')}}" class="boxed-btn">Sign in</a>
                            <a href="{{route('register')}}" class="boxed-btn blank">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>
<!-- end header-area -->


@yield('content')

<!-- footer area start -->
<footer class="footer-area footer-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="copyright-area">
                    <span> {{$general->footer}}</span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="footer-logo">
                    <a href="{{url('/')}}">
                        <img  style="max-width: 240px; max-height: 54px;" src="{{asset('assets/images/fontend_logo/logo.png')}}" alt="footer logo">
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="footer-socials">
                    <ul>
                        @foreach($social as $data)
                            <li>
                                <a href="{{$data->link}}" target="_blank"><i class="fab {{$data->icon}}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- back to top btn start -->
<div class="back-to-top" style="display: block;">
    <i class="fas fa-angle-up"></i>
</div>
<!-- back to top btn end -->

<!-- preloader area start -->
<div class="preloader">
    <div class="loader">
        <div class="image-1">
            <img src="{{asset('assets/images/fontend_logo/icon.png')}}" alt="preloader image">
        </div>
    </div>
</div>
<!-- preloader area end -->

<!-- jquery -->
<script src="{{asset('assets/front_assets/js/jquery.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('assets/front_assets/js/bootstrap.min.js')}}"></script>
<!-- slicknav -->
<script src="{{asset('assets/front_assets/js/jquery.slicknav.min.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('assets/front_assets/js/owl.carousel.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('assets/front_assets/js/jquery.magnific-popup.js')}}"></script>
<!-- way point -->
<script src="{{asset('assets/front_assets/js/waypoints.min.js')}}"></script>
<!-- counter up -->
<script src="{{asset('assets/front_assets/js/jquery.counterup.min.js')}}"></script>
<!-- Isotope -->
<script src="{{asset('assets/front_assets/js/isotope.pkgd.min.js')}}"></script>
<!-- Progress Bar -->
<script src="{{asset('assets/front_assets/js/jquery.lineProgressbar.js')}}"></script>
<!-- main -->
<script src="{{asset('assets/front_assets/js/main.js')}}"></script>
@yield('script')
</body>

</html>