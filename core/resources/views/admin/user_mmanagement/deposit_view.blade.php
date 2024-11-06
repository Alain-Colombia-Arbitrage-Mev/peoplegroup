@extends('master')
@section('site-title')
    Depósitos
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if($trans_object == null)
                <div class="col-md-12">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-user"></i> Usuario</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 class="bold" style="color: red">No hay depósitos <i class="far fa-smile"></i></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
            <h3 class="bold">Depósitos de {{$trans_object->member->first_name }} {{$trans_object->member->last_name }}</h3>
            <div class="row">
                <div class="col-md-12">
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
                                    <th> ID </th>
                                    <th> Fecha </th>
                                    <th> ID Transacción </th>
                                    <th> Método</th>
                                    <th> Valor</th>
                                    <th> Cargo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trans as $key => $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td> {{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}</td>
                                        <td>{{$data->trx}}</td>
                                        <td>{{ $data->method_name->name}}</td>
                                        <td>{{ $data->amount}} USD</td>
                                        <td>{{ $data->trx_charge}} USD</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            @endif
        </div>
    </div>
@endsection

