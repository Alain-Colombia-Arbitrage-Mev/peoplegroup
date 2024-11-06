@extends ('fonts.layouts.blog_master')
@section('style')
    <link href="{{url('/')}}/assets/front_assets/register.css" rel="stylesheet">
    <style>
        body{
            background-image: url("assets/front_assets/img/login_bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .pranto {
            padding: 0px;
        }
        .checkbox-panel {
            color: white;
            display: block;
            margin-left: 0px;
            padding-left: 37px;
        }
        .help-block {
            display: block;
            margin-top: 15px;
            color: #737373;

        }
        .saddam {
            height: 25px;
            position: relative;
            -webkit-transform: translateY(0px);
            transform: translateY(0px);
            left: 0px;
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
            -webkit-backface-visibility: hidden;
            pointer-events: auto ;
            font-size: 22px;
        }
        .form {
           	background: #000000b3;
            padding: 40px;
            max-width: 500px;
            margin: 40px auto;
            border-radius: 4px;
            box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
            margin-top: 5%;
        }
        .reg-forget {
            float: left!important;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .button{
            font-size: 20px ; !important;
        }

        .help-block {
            display: block;
            margin-top: 15px;
            color: #c13636;
        }

    </style>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="login-page">
        <div class="form">
            <div class="tab-content">
                <div id="student">
                <div>
                <img src="{{url('/')}}/assets/front_assets/img/logo.jpg}}" alt="">
                </div>
                    <h1>Iniciar Sesión</h1>
                    <form method="post" action="{{ route('login') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 pranto">
                                <div class="field-wrap {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label>
                                        Usuario
                                    </label>
                                    <input type="text" name="username" id="username"/>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 pranto">
                                <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>
                                        Clave
                                    </label>

                                    <input type="password" name="password" id="password"/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <a class="pull-right forgot-password reg-forget" href="{{url('password/reset')}}">Olvidó su contraseña ?</a>
                            </div>
                        </div><!--ROW-->

                        <button type="submit"  class="button button-block">Iniciar Sesión</button>
                    </form>

                </div>

                <div id="sdfsd"></div>
            </div><!-- tab-content -->
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $('.form').find('input, textarea').on('keyup blur focus', function (e) {

                var $this = $(this),
                    label = $this.prev('label');

                if (e.type === 'keyup') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.addClass('active highlight');
                    }
                } else if (e.type === 'blur') {
                    if( $this.val() === '' ) {
                        label.removeClass('active highlight');
                    } else {
                        label.removeClass('highlight');
                    }
                } else if (e.type === 'focus') {

                    if( $this.val() === '' ) {
                        label.removeClass('highlight');
                    }
                    else if( $this.val() !== '' ) {
                        label.addClass('highlight');
                    }
                }else {
                    label.addClass('active');
                }

            });

            $('.tab a').on('click', function (e) {

                e.preventDefault();

                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');

                target = $(this).attr('href');

                $('.tab-content > div').not(target).hide();

                $(target).fadeIn(600);

            });
        });
    </script>
@endsection

