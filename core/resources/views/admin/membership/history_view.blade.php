@extends('master')
@section('site-title')
    Transacciones
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="bold">Detalle de Movimientos</h3>
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
                            <table class="table table-striped table-bordered table-hover" id="sample_19">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Transaction ID </th>
                                    <th> Fecha </th>
                                    <th> Usuario </th>
                                    <th> Descripción</th>
                                    <th> Valor</th>
                                    <th> Cargo</th>
                                    <th> Nuevo saldo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trans as $key => $data)
                                    <tr class="@if($data->amount <= 0) danger @else success @endif">
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->trans_id}}</td>
                                        <td> {{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}</td>
                                        <td> {{$data->member->first_name}}  {{$data->member->last_name}} ( {{$data->member->username}} )</td>
                                        <td>{{ $data->description }}</td>
                                        <td><b>{{$data->amount}} {{$general->symbol}}</b></td>
                                        <td><b>{{$data->charge}} {{$general->symbol}}</b></td>
                                        <td><b>{{$data->new_balance}} {{$general->symbol}}</b></td>
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

