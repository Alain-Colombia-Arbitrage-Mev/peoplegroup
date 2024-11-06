@extends('fonts.layouts.user')
@section('site')
    | Invest Preview
@endsection
@section('style')
   <style>
       li.list-group-item {
           font-size: 20px;
       }
   </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
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

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row">

                <div class="col-md-12">
                    <div class="portlet box blue-ebonyclay">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-th"></i> Preview  </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-inverse">
                                        <div class="panel-heading">
                                            <h3 class="text-center bold">Preview of Investment</h3>
                                        </div>
                                        <div class="panel-body table-responsive text-center">
                                            <form action="{{route('confirm.lend.store')}}" method="post">
                                                {{csrf_field()}}
                                                <div class="panel-body table-responsive text-center">
                                                    <ul class="list-group">
                                                        <input type="hidden" name="lend_amount" value="{{$amount}}">
                                                        <input type="hidden" name="package_id" value="{{$pack->id}}">
                                                        <input type="hidden" name="back_amount" value="{{$daily_back}}">

                                                        <li class="list-group-item">Lend Amount: <strong>{{$amount}}</strong> {{$general->symbol}}</li>
                                                        <li class="list-group-item">Return Percentage: <strong>{{$pack->percent}} %</strong></li>
                                                        <li class="list-group-item" style="color: green"> Return Money Back {{$daily_back}} {{$general->symbol}},  After every {{$pack->period}} Hours</li>
                                                    </ul>
                                                </div>

                                                <div class="panel-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Confirm To Invest</button>
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
    </div>
@endsection


