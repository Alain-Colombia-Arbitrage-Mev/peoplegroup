<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$general->web_title}} @yield('site') </title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fontend_logo/icon.png')}}">
    <!--bootstrap Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--font-awesome Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/icofont.min.css')}}" rel="stylesheet">
    <!--owl.carousel Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/owl.carousel.min.css')}}" rel="stylesheet">
    <!--Slick Nav Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/slicknav.min.css')}}" rel="stylesheet">
    <!--Animate Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/animate.css')}}" rel="stylesheet">
    <!--Style Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/style.css')}}" rel="stylesheet">
    <!--Responsive Css-->
    <link href="{{asset('assets/front_assets/blog_assets/css/responsive.css')}}" rel="stylesheet">

    <link href="{{url('/')}}/assets/front_assets/colors/base-color.php?color={{$general->theme}}" rel="stylesheet">
<link href="{{url('/')}}/assets/front_assets/colors/secondary-color.php?color={{$general->sec_color}}"  rel="stylesheet">

<!--jquery script load-->
    <script src="{{asset('assets/front_assets/blog_assets/js/jquery.js')}}"></script>
    @yield('style')
</head>

<body>
<!--navbar area start-->
<nav class="navbar-area" >
    <div class="container">
        <div class="row">
            <div class="col-lg-3 ">
                <a href="{{url('/')}}" class="logo">
                    <img style="max-height: 78px; margin-top: -14px;" src="{{asset('assets/images/fontend_logo/logo.png')}}" alt="Logo">
                </a>
            </div>
            <div class="col-lg-9 text-right ">
                <ul id="main-menu">



                    @guest                        
                        <li class="<?php echo request()->path() == 'login' ? 'menu-active dropdown open' : ''; ?>"><a href="{{route('login')}}"> Iniciar Sesión</a></li>
                        <li class="<?php echo request()->path() == 'register' ? 'menu-active dropdown open' : ''; ?>"><a href="{{route('register')}}"> Registrarse</a></li>
                    @else
                        <li><a href="{{url('/home')}}"> Tablero</a></li>
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
<!--navbar area end-->



@yield('content')



<!--subscription area start-->
<footer class="subscription-area">
   @if(request()->path() != "authorization")

        

   @endif
    <!--footer area start-->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright-text text-center"> {{$general->footer}}</p>
                </div>
            </div>
        </div>
    </div>
    <!--footer area end-->
</footer>
<!--subscription area end-->
<!--preloader start-->
<div class="preloader">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img  style="max-width: 100%;" src="{{asset('assets/images/fontend_logo/icon.png')}}" alt="preloader image">
        </div>
    </div>
</div>
<!--preloader end-->

<!--back to top start-->
<div class="back-to-top">
    <i class="icofont icofont-simple-up"></i>
</div>
<!--back to top end-->


<!--Owl carousel script load-->
<script src="{{asset('assets/front_assets/blog_assets/js/owl.carousel.min.js')}}"></script>
<!--Propper script load here-->
<script src="{{asset('assets/front_assets/blog_assets/js/popper.min.js')}}"></script>
<!--Bootstrap v4 script load here-->
<script src="{{asset('assets/front_assets/blog_assets/js/bootstrap.min.js')}}"></script>
<!--Slick Nav Js File Load-->
<script src="{{asset('assets/front_assets/blog_assets/js/jquery.slicknav.min.js')}}"></script>
<!--Scroll Spy File Load-->
<script src="{{asset('assets/front_assets/blog_assets/js/scrollspy.min.js')}}"></script>
<!--Wow Js File Load-->
<script src="{{asset('assets/front_assets/blog_assets/js/wow.min.js')}}"></script>
<!--Main js file load-->
<script src="{{asset('assets/front_assets/blog_assets/js/main.js')}}"></script>
@yield('script')
</body>

</html>