@extends('fonts.layouts.user')
@section('site')
    | Historial de transacciones
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Historial de transacciones</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">

                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th width="5%"> # </th>
                                    <th>Número de transacción </th>
                                    <th>Fecha </th>
                                    <th>Descripción </th>
                                    <th width="10%">Valor </th>
                                    <th>Cargo</th>
                                    <th>Nuevo Saldo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trans as $key=>$data)
                                    <tr class="@if($data->amount <= 0) danger @else success @endif">
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->trans_id}}</td>
                                        <td>{{date('Y-m-d H:i:s', strtotime($data->created_at))}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>{{$data->amount}} {{$general->symbol}}</td>
                                        @if($data->charge != 0)
                                            <td>{{ $data->charge }} {{$general->symbol}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{round($data->new_balance,4)}} {{$general->symbol}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

