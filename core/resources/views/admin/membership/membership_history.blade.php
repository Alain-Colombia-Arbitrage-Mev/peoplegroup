@extends('master')
@section('site-title')
    Histórico de membresías
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
                                    <span class="caption-subject bold uppercase">Histórico de membresías compradas</span>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fecha</th>
                                            <th>usuario</th>
                                            <th>Membresía</th>
                                            <th>Estado</th>
                                            <th>Valor</th>
                                            <th>Acción</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trans as $key=> $data)
                                            <tr id="row1">
                                                <td> <b>{{$data->id}}</b></td>
                                                <td> {{$data->created_at}}</td>
                                                <td> {{$data->user->first_name}}  {{$data->user->last_name}} ( {{$data->user->username}} )</td>
                                                <td> {{$data->membership->tittle}} @if($data->is_upgrade) (Actualización)@endif</td>
                                                <td>@if($data->status == 0)
                                                        <span class="badge badge-pill badge-warning" style="color: black">Pendiente</span>
                                                        @elseif($data->status == 1)
                                                        <span class="badge badge-pill badge-success" style="color: black">Procesada</span>
                                                    @endif
                                                </td>
                                                <td> {{$data->amount}} {{$general->currency}}</td>                                                
                                                <td><a class="btn dark" href="{{route('membership.history.view', $data->id)}}">Ver Movimientos </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$trans->links()}}
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