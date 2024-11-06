<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('site-title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fontend_logo/icon.png')}}"/>
    @include('template-part.style')
    @yield('style')
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!--preloader start-->
<div class="preloader">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img style="width: 50%;" src="{{asset('assets/images/Loader.gif')}}" alt="Preloader Image">
        </div>
    </div>
</div>
<!--preloader end-->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">

        <div class="page-logo">

            <a href="">
                <img class="logo" style="max-height: 100%; max-width: 25%; margin-top: 8px;" src="{{asset('assets/images/fontend_logo/logo.png')}}">
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                     <span class="username username-hide-on-mobile">

                     {{Auth::guard('admin')->user()->name}}
                     </span>
                        <i style="color: white" class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#changePassword" data-toggle="modal">
                                <i class="icon-settings"></i> Cambiar Clave
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.logout')}}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <i class="icon-key"></i> Cerrar sesión
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
    @include('template-part.sidebar')
    @yield('main-content')
</div>

<div class="modal fade" id="changePassword" tabindex="-1" role="changePassword" aria-hidden="true">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{route('change.password')}}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->id}}" name="id">
                    <div class="form-group{{ $errors->has('passwordold') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contrasela actual</label>
                        <div class="col-md-6">
                            <input id="passwordold" type="password" class="form-control" name="passwordold" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('passwordold') }}</strong>
                               </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Nueva contraseña</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                               </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
                        <button class="btn green" type="submit">Cambiar</button>
                    </div>
                </form>
            </div>
        </div>
   
</div>

@include('template-part.footer')
@include('template-part.script')
@if(Session::has('msg'))
    <script>
        $(document).ready(function(){
            swal("{{Session::get('msg')}}","", "success");

        });
    </script>
@endif
@if(Session::has('delmsg'))
    <script>
        $(document).ready(function(){
            swal("{{Session::get('delmsg')}}","", "warning");
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