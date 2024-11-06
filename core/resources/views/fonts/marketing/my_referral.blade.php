@extends('fonts.layouts.user')
@section('site')
    | Referidos
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Listado de referidos</h3>
            @if(Auth::user()->level !=3)
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
                                    <th width="10%"> SL# </th>
                                    <th> Username </th>
                                    <th> Nombre Completo </th>
                                    <th> Email </th>
                                    <th> Fecha de alta </th>
                                    <th> Plan </th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ref as $key => $data)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$data->username}}</td>
                                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->join_date }}</td>
                                        <td>{{ $data->membership->tittle }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else

                <div class="col-md-12">
                    <div class="alert alert-danger"  role="alert">
                        <h3 class="text-center bold">You Game Is Over, You Can Only Withdraw Your Money  <i class="far fa-smile"></i></h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
