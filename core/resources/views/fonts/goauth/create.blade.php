@extends('fonts.layouts.user')
@section('site')
    | Security
@endsection
@section('style')
    <style>
        /*responsive for user dashboard*/
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .input-lg {
                width: 100%!important;
            }
        }

        @media only screen and (max-width: 480px) { 

                input#code {
                    font-size:  14px;
                    width: 101% !important;
                }
        }

button.btn.btn-block.btn-lg.btn-primary.small-font-size-in-mobile-device {
    font-size: 14px;
}
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Seguridad</h3>
            <div class="row">
                <div class="portlet-body">
                            <div class="col-md-8">

                                @if (count($errors) > 0)
                                    <div class="row">
                                        <div class="col-md-06">
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                @endif

                                @if (Session::has('alert'))
                                    <div class="alert alert-danger">{{ Session::get('alert') }}</div>
                                @endif


                                @if(Auth::user()->tauth == '1')
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Autenticación de dos factores</h4>
                                        </div>
                                        <div class="panel-body text-center">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" value="{{$prevcode}}" class="form-control input-lg" id="code" readonly>
                                                    <span class="input-group-addon btn btn-success" id="copybtn">Copy</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <img src="{{$prevqr}}">
                                            </div>
                                            <button type="button" class="btn btn-block btn-lg btn-danger" data-toggle="modal" data-target="#disableModal">Desactivar Autenticación de dos factores</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Autenticación de dos factores</h4>
                                        </div>
                                        <div class="panel-body text-center">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="key" value="{{$secret}}" class="form-control input-lg" id="code" readonly>
                                                    <span class="input-group-addon btn btn-success" id="copybtn">Copiar</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <img src="{{$qrCodeUrl}}">
                                            </div>
                                            <button type="button" class="btn btn-block btn-lg btn-primary small-font-size-in-mobile-device" data-toggle="modal" data-target="#enableModal">Habilitar Autenticación de dos factores</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-inverse" >
                                    <div class="panel-heading">
                                        <h4 class="panel-title bold">Google Authenticator</h4>
                                    </div>
                                    <div class="panel-body text-justify">
                                        <h5 style="text-transform: capitalize;">Use Google Authenticator para escanear el código QR o use el código</h5><hr/>
                                        <p>Google Authenticator es una aplicación multifactor para dispositivos móviles. Genera códigos temporizados utilizados durante el proceso de verificación de 2 pasos. Para usar Google Authenticator, instale la aplicación Google Authenticator en su dispositivo móvil.</p>
                                        <a class="btn btn-info btn-md" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">Descargar APP</a>
                                    </div>
                                </div>
                            </div>


                            <script type="text/javascript">
                                document.getElementById("copybtn").onclick = function()
                                {
                                    document.getElementById('code').select();
                                    document.execCommand('copy');
                                }
                            </script>

                            <!--Enable Modal -->
                            <div id="enableModal" class="modal fade" role="dialog">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Verificar OTP</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('go2fa.create')}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="hidden" name="key" value="{{$secret}}">
                                                    <input type="text" class="form-control" name="code" placeholder="Ingrese el código de Google Authenticator">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success btn-block">Verificar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                            </div>

                            <!--Disable Modal -->
                            <div id="disableModal" class="modal fade" role="dialog">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Verificar OTP para desactivar</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('disable.2fa')}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="code" placeholder="Ingrese el código de Google Authenticator">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success btn-block">Verificar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                            </div>

                        </div>
            </div>
        </div>
    </div>
@endsection