@extends('master')
@section('site-title')
   Lending Referral Bonus
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
                                    <th> User </th>
                                    <th> Lend Amount </th>
                                    <th> Referral User </th>
                                    <th> User Position Under </th>
                                    <th> Referral User Bonus</th>
                                    <th width="10%"> Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lend as $key=>$data)
                                    <tr>
                                        <td>
                                            <p><a href="{{route('user.view', $data->member->id)}}">{{$data->member->first_name}} {{$data->member->last_name}}</a> </p>
                                            <p>{{$data->member->email}}</p>
                                        </td>
                                        <td>{{$data->lend_amount}} {{$general->symbol}}</td>
                                        @php $ref = \App\User::where('id', $data->member->referrer_id )->first(); @endphp
                                        <td><p><a href="{{route('user.view', $ref->id)}}">{{$ref->first_name}} {{$ref->last_name}}</a> </p>
                                            <p>{{$ref->email}}</p></td>

                                        @php $pos = \App\User::where('id', $data->member->posid )->first(); @endphp
                                        <td><p><a href="{{route('user.view', $ref->id)}}">{{$pos->first_name}} {{$pos->last_name}}</a> </p>
                                            <p>{{$pos->email}}</p></td>
                                        @php $com = ($data->package->lend_bonus * $data->lend_amount)/100  @endphp
                                        <td>
                                            @if($com == '')

                                            @else
                                                {{$com}} {{$general->symbol}}
                                        @endif
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