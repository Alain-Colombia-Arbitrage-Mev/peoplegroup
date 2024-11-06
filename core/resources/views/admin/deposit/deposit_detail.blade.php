@extends('master')
@section('site-title')
    Detalle del depósito
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-010">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alerta!</h4>
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
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Detalle del depósito</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Descripción</th>
                                                <td><b>Detalle</b></td>
                                            </tr>
                                            <tr>
                                                <th>Transacción:</th>
                                                <td>{{$data->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nombre:</th>
                                                <td><a href="{{route('user.view', $data->member->id)}}">{{$data->member->first_name}} {{$data->member->last_name}}</a></td>
                                            </tr>

                                            <tr>
                                                <th>Email:</th>
                                                <td>{{$data->member->email}} </td>
                                            </tr>

                                            <tr>
                                                <th>Valor del depósito</th>
                                                <td>{{$data->amount}} {{$general->currency}}</td>
                                            </tr>

                                            <tr>
                                                <th>Cargo del  depósito</th>
                                                <td> {{$data->trx_charge}} {{$general->currency}}</td>
                                            </tr>

                                            <tr>
                                                <th>Método de pago</th>
                                                <td> <b>{{$data->method_name->name}} </b></td>
                                            </tr>

                                            <tr>
                                                <th>Fecha de Inicio del depósito</th>
                                                <td>  {{ date('Y-m-d H:i:s', strtotime($data->created_at)) }}</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <form class="form-horizontal" method="post" action="{{route('deposit.process', $data->id)}}">
                                            {{csrf_field()}}
                                           <div class="form-body">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <strong class="col-md-12">Observaciones</strong>
                                                           <hr>
                                                           <textarea class="form-control col-md-12" name="message" rows="5" required></textarea>
                                                       </div>
                                                       <button type="submit" name="status" value="1" class="btn btn-success pull-left">Aprobar Depósito</button>
                                                       <button type="submit" name="status"  value="3" class="btn red pull-right">Rechazar</button>
                                                   </div>
                                               </div>
                                           </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });
    </script>
@endsection