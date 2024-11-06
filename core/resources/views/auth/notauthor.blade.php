@extends ('fonts.layouts.blog_master')
@section('site')
    | Dashboard
@endsection
@section('style')
   <style>
       input[type=text], .form-element input[type=email], input[type=email], input[type=tel], input[type=url], input[type=password], input[type=number], textarea {
           padding: 10px 20px;
           margin-bottom: 20px;
            border: 1px solid cornflowerblue;
           width: 100%;
           border-radius: 5px;
       }
       .blog-single-page .content{
           border: 1px solid green;
           padding: 50px;
       }

       @media only screen and (max-width : 320px) {
           .blog-single-page .content{
               border: none;
               padding: 0px;
           }
       }
   </style>
@endsection
@section('content')
    <!--blog page start-->
    <section class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('alert'))
                                <div class="alert alert-danger">{{ Session::get('alert') }}</div>
                            @endif
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif

                            <div class="blog-single-page">
                                @if (Auth::user()->status != '1')
                                    <h3 style="color: #cc0000; text-align: center;" >Tu cuenta está bloqueada</h3>

                                @elseif(Auth::user()->emailv != '1')
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="content">
                                                <div class="text-center">Por favor verifica tu dirección de correo electónico</div>
                                                <div class="card-body text-center">
                                                    <p>Tu dirección de Email:</p>
                                                    <h3>{{Auth::user()->email}}</h3>
                                                    <form action="{{route('sendemailver')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <button type="submit" class="btn btn-lg btn-block btn-primary">Enviar código de verificación</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="content">
                                                <div class="card-title text-center">Verificar Código</div>

                                                <form action="{{route('emailverify') }}" method="POST">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="code" placeholder="Digite código de verificación" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-block btn-success">Verificar</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->smsv != '1')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-title text-center">Please verify your Mobile</div>
                                                <div class="card-body">
                                                    <p>Your Mobile no:</p>
                                                    <h3>{{Auth::user()->mobile}}</h3>
                                                    <form action="{{route('sendsmsver')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <button type="submit" class="btn btn-lg btn-block btn-primary">Send Verification Code</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-title text-center">Verify Code</div>

                                                <form action="{{route('smsverify') }}" method="POST">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="code" placeholder="Enter Verification Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-block btn-lg btn-success">Verify</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->tfver != '1')
                                    <div class="col-md-12">

                                        <h2 class="text-center">Verificar Código de Google Authenticator</h2>
                                        <div class="form-body">
                                            <form action="{{route('go2fa.verify') }}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" name="code" required placeholder="Ingresar código de Google Authenticator">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success btn-block">Verificar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--blog page end-->

@endsection
