@extends ('fonts.layouts.blog_master')
@section('style')
    <link href="{{url('/')}}/assets/front_assets/register.css" rel="stylesheet">
    <style>
        body {
            background-image: url("assets/front_assets/img/registration.jpg");
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
            margin-top: 25px;
            color: red;
            font-size: 14px;

        }
        .saddam {
            height: 25px;
            width: 15px;
            float: left;
            margin-right: 10px;
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

        input[type="date"] {
            border: 1px solid #789287;
            padding: 15px 20px;
            font-size: 16px;
        }
        @media only screen and (max-width : 480px) {
            label {
                font-size:  16px;
                line-height: 2.5;
            }
        }

        .button{
            font-size: 20px ; !important;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    <h1>Registrarse</h1>
                    <form method="post" action="{{ route('register') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 pranto">
                                <div class="col-md-12  {{ $errors->has('referrer_id') ? ' has-error' : '' }}">
                                    <div class="field-wrap">
                                        <label class="@if ($ref_name != '') highlight active @endif">
                                            Usuario patrocinador {{$patrocinador}}<span class="req">*</span>
                                        </label>
                                        <input type="text" id="ref_name" required autocomplete="off" value="{{$ref_name}}" @if ($ref_name != '') disabled @endif readOnly/>
                                        @if ($ref_name != '') <input type="hidden" id="referrer_id" value="{{$referrer_id}}" name="referrer_id">@endif
                                        <div id="ref">

                                        </div>
                                        @if ($errors->has('referrer_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('referrer_id') }}</strong>
												
                                            </span>
                                        @endif
                                    </div>

                                </div>
                            </div>



                            <div class="col-md-12 pranto">
                                <div class="col-md-12  {{ $errors->has('referrer_id') ? ' has-error' : '' }}">
                                    <div class="field-wrap">
                                        <label class="highlight active">
                                            Wallet Ethereum <span class="req">*</span>
                                        </label>
                                        <input type="text" name="wallet" required autocomplete="off" value=""/>
                                        <!-- @if ($ref_name != '') <input type="hidden" id="referrer_id" value="{{$referrer_id}}" name="referrer_id">@endif -->

                                        </div>
                                        <!-- @if ($errors->has('referrer_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('referrer_id') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pranto">
                                <div class="col-md-12">
                                    <div class="field-wrap {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label>
                                            Nombres<span class="req">*</span>
                                        </label>
                                        <input required type="text" name="first_name" value="{{old('first_name')}}">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 pranto">
                                <div class="col-md-12">
                                    <div class="field-wrap {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label>
                                            Apellidos<span class="req">*</span>
                                        </label>
                                        <input  type="text" required name="last_name" value="{{old('last_name')}}">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pranto">
                                <div class="col-md-12">
                                    <div class="field-wrap {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label>
                                            Email <span class="req">*</span>
                                        </label>
                                        <input required type="email"  name="email" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 pranto">
                                <div class="col-md-12">
                                    <div class="field-wrap {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label>
                                            Celular<span class="req">*</span>
                                        </label>
                                        <input required type="text"  name="mobile" value="{{old('mobile')}}">
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('mobile') }}</strong>
                                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="field-wrap {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label>
                                        Username <span class="req">*</span>
                                    </label>
                                    <input required type="text" name="username" value="{{old('username')}}">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>
                                        Clave <span class="req">*</span>
                                    </label>
                                    <input required type="password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="field-wrap">
                                    <label>
                                        Confirmar clave <span class="req">*</span>
                                    </label>
                                    <input type="password" required name="password_confirmation">
                                </div>
                            </div> -->
                        </div>

                        <button type="submit" class="button button-block">Registrarse</button>

                    </form>

                </div>

                <div id="sdfsd"></div>
            </div><!-- tab-content -->
        </div>
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
    <script>

        window.onload = function () {

            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('sponsor');

            //console.log("searchParams", myParam);
            var ref_id = myParam //$('#ref_name').val();
            var token = "{{csrf_token()}}";


            $("#ref_name").val(myParam)

            $.ajax({
                type: "POST",
                url:"{{route('get.ref.id')}}",
                data:{
                    'ref_id': ref_id ,
                    '_token' : token
                },
                success:function(data){
                    $("#ref").html(data);

                }
            });


        }

        $(document).ready(function () {

        

            // $(document).on('load','#ref_name',function() {
            //     var ref_id = $('#ref_name').val();
            //     var token = "{{csrf_token()}}";


            //     $.ajax({
            //         type: "POST",
            //         url:"{{route('get.ref.id')}}",
            //         data:{
            //             'ref_id': ref_id ,
            //             '_token' : token
            //         },
            //         success:function(data){
            //             $("#ref").html(data);

            //         }
            //     });
            // });
        });
    </script>
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
            $('.form').find('input, textarea').on('click blur focus', function (e) {

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
