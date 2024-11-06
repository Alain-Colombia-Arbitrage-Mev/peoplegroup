@extends('fonts.layouts.user')
@section('site')
    | Invest | History
@endsection

@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Invest History</h3>
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
                                    <th width="10%"> SL </th>
                                    <th> Lending Package </th>
                                    <th> Amount </th>
                                    <th> Return Time </th>
                                    <th> Already Return </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($money as $key => $data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->package->title}}</td>
                                        <td>{{$data->back_amount}}  {{$general->symbol}}</td>
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
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection