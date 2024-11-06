<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{$general->web_title}} @yield('site')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="{{asset('assets/fonts/css/user-responsive.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fontend_logo/icon.png')}}"/>
    @include('template-part.style')
    @yield('style')
    <style>
        .page-header.navbar {
            background-color: #257db9;
        }
        .page-sidebar .page-sidebar-menu>li.active.open>a, .page-sidebar .page-sidebar-menu>li.active>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active>a
        ,.page-sidebar:hover .page-sidebar-menu>li.active>a:hover,
        .page-sidebar .page-sidebar-menu>li.open>a, .page-sidebar .page-sidebar-menu>li:hover>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li:hover>a
        {
            background-color: #257db9;
        }

        .logo.desktop-logo {
            width:60px;
            margin-top: 3px;
			height:auto;
        }
        a.dt-button.btn.yellow.btn-outline {
            display: none;
        }
        .preloader-img img {
        -webkit-animation: rotatingTWo 7s linear infinite;
        animation: rotatingTWo 7s linear infinite; }
    </style>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!--preloader start-->
<div class="preloader">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img style="max-width: 70%" src="{{asset('assets/images/fontend_logo/logo.png')}}" alt="Preloader Image">
        </div>
    </div>
</div>
<!--preloader end-->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">

        <div class="page-logo">

            <a href="{{route('home')}}">
                <img class="logo desktop-logo" src="{{asset('assets/images/fontend_logo/logo.png')}}">
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <div class="top-menu">
            <ul class="nav navbar-nav">
                @if(Auth::user()->paid_status == 100 && request()->path() != 'withdraw/preview' && request()->path() != 'deposit/store')
                    <li><marquee style="text-align: center;color: #fff; margin-top: 15px;">You will Get {{$general->symbol}} {{$charge->update_commision_tree}} {{$general->currency}} When any of Your Below Tree Member Upgrade To Premium Account.</marquee> </li>

                @endif
                <li style="font-size: 20px; color: white; margin-top: 10px;"><b>Saldo: {{round(Auth::user()->balance, 4)}} {{$general->symbol}} <span> </span></b></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                     <span class="username username-hide-on-mobile">
                        <b> Bienvenid@,
                            {{Auth::user()->first_name}}
                            {{Auth::user()->last_name}}</b>
                     </span>
                        <i style="color: white" class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ route('profile.index') }}">
                                <i class="fas fa-user"></i> Mi perfil
                            </a>
                        </li><li>
                            <a href="{{ route('security.index') }}">
                                <i class="fas fa-key"></i> Cambiar Clave
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <i class="fas fa-lock"></i> Cerrar Sesión
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"> </div>
<div class="page-container">
    @include('template-part.user_sidebar')
    @yield('main-content')
</div>
@include('template-part.footer')
@include('template-part.script')

@if(Session::has('message'))
    <script>
        $(document).ready(function(){
            swal("{{Session::get('message')}}","", "success");

        });
    </script>
@endif
@if(Session::has('alert'))
    <script>
        $(document).ready(function(){
            swal("{{Session::get('alert')}}","", "warning");
        });

    </script>
@endif
@yield('script')
</body>
</html>