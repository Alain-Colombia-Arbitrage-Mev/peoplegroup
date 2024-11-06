@extends('master')
@section('site-title')
    Depósitos por verificar
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
                                    <span class="caption-subject bold uppercase">Depositos por verificar</span>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre del miembro</th>
                                            <th>Monto</th>
                                            <th>Método</th>
                                            <th>Estado</th>
                                            <th>Acción</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposit as $key=> $data)
                                            <tr id="row1">
                                                <td> <b>{{$data->id}}</b></td>
                                                <td> {{$data->member->first_name}} {{$data->member->last_name}} </td>
                                                <td> {{$data->amount}} {{$general->currency}}</td>
                                                <td><b>{{$data->method_name->name}} </b></td>
                                                <td>@if($data->status == 0)
                                                        <span class="badge badge-pill badge-warning" style="color: black">Pendiente</span>
                                                        @elseif($data->status == 1)
                                                        <span class="badge badge-pill badge-success" style="color: black">Aprobado</span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger" style="color: black">Rechazado</span>
                                                    @endif
                                                </td>
                                                <td><a class="btn dark" href="{{route('deposit.detail.user', $data->id)}}">Verificar </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$deposit->links()}}
                                        </div>
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