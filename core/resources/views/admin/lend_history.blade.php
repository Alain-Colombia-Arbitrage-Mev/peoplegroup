@extends('master')
@section('site-title')
   Lending History
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Lending Log</h3>
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-010">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

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
                                    <th> Sl </th>
                                    <th> User </th>
                                    <th> Lend Amount </th>
                                    <th> Get Amount </th>
                                    <th> Package </th>
                                    <th> Returning Time</th>
                                    <th> Already Return</th>
                                    <th> Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lend as $key=>$data)
                                    <tr>
                                        <td >{{$key+1}}</td>
                                        <td>
                                            <p><a href="{{route('user.view', $data->member->id)}}">{{$data->member->first_name}} {{$data->member->last_name}}</a> </p>
                                            <p>{{$data->member->email}}</p>
                                        </td>
                                        <td>{{$data->lend_amount}} {{$general->symbol}}</td>
                                        <td>{{$data->back_amount}} {{$general->symbol}}</td>
                                        <td>{{$data->package->title}}</td>
                                        <td>{{$data->package->action}}</td>
                                        <td>{{$data->remain}}</td>
                                        <td>
                                            @if($data->status == 1)
                                                <span class="badge badge-primary">Continue</span>
                                            @else
                                                <span class="badge badge-success">Complete</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection