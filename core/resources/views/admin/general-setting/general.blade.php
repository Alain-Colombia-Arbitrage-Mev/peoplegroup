@extends('master')
@section('site-title')
    General Setting
@endsection
@section('style')
    <link href="{{url('/')}}/assets/admin_assets/css/spectrum.css" rel="stylesheet">
    <style>
        .pranto span{
            padding: 0px;

        }
        .pranto span input[type="text"]{
            border:none;

        }
        .pranto input{
            padding: 23px 5px;

        }
        .datepicker {
            padding: 23px 5px;
            border-radius: 4px;
            direction: ltr;
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-010">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h12><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h12>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
            <div class="row">

                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-th"></i> Configuración General
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                                <form method="POST" action="{{route('general.update', $general->id)}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('put')}}

                                    <div class="form-group col-md-4">
                                        <strong class="col-md-12 ">Nombre del Sitio:
                                        </strong>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="web_title" required value="{{$general->web_title}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong class="col-md-12 ">Moneda:
                                        </strong>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="currency" required value="{{$general->currency}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong class="col-md-12 ">Símbolo de moneda:
                                        </strong>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="symbol" required value="{{$general->symbol}}">
                                        </div>
                                    </div>

                                    <div class="form-group  col-md-4" hidden>
                                        <strong class="col-md-12 ">Web Color Code (Without '#')</strong>
                                        <div class="input-group pranto col-md-12">
                                            <span class="input-group-addon ">
                                                <input type='text' class="form-control" id="base_color" value="{{$general->theme}}"/>
                                            </span>
                                            <input type="text" readonly name="theme"  class="form-control" id="base_color_value" value="{{$general->theme}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4" hidden>
                                        <strong class="col-md-12 ">Web Secondary Color Code (Without '#')
                                        </strong>

                                        <div class="input-group pranto col-md-12" >
                                            <span class="input-group-addon ">
                                                <input type='text' class="form-control" id="sec_color" value="{{$general->sec_color}}"/>
                                            </span>
                                            <input type="text" readonly name="sec_color" class="form-control" id="sec_color_value" value="{{$general->sec_color}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4" hidden>
                                        <strong class="col-md-12 ">Working Start Date
                                        </strong>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control datepicker" required name="start_date"  value="{{$general->start_date}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <strong class="col-md-12 ">Verificación de Email al inscribir cuenta
                                        </strong>
                                        <div class="col-md-12">
                                            <input name="emailver" data-toggle="toggle" {{ $general->emailver == "0" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="On" data-off="Off"  data-width="100%" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3" hidden>
                                        <strong class="col-md-12 ">VERIFICATION SMS</strong>
                                        <div class="col-md-12">
                                            <input name="smsver" data-toggle="toggle" {{ $general->smsver == "0" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="On" data-off="Off"  data-width="100%" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <strong class="col-md-12 ">Notificaciones de Email</strong>
                                        <div class="col-md-12">
                                            <input name="email_nfy" data-toggle="toggle" {{ $general->email_nfy == "1" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="On" data-off="Off"  data-width="100%" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3" hidden>
                                        <strong class="col-md-12 ">Notificación SMS</strong>
                                        <div class="col-md-12">
                                            <input name="sms_nfy" data-toggle="toggle" {{ $general->sms_nfy == "1" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="On" data-off="Off"  data-width="100%" type="checkbox">
                                        </div>
                                    </div>

                            <div class="form-actions">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn-block btn dark"><i class="fa fa-check"></i> Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('/')}}/assets/admin_assets/spectrum.js"></script>
  <script>
      $('#base_color').spectrum({
          color: $('#base_color').val(),
          change: function (color) {
              $('#base_color_value').val(color.toHexString().slice(1));
          }
      });

      $('#sec_color').spectrum({
          rong: $('#sec_color').val(),
          change: function (rong) {
              $('#sec_color_value').val(rong.toHexString().slice(1));
          }
      });
  </script>
@endsection
