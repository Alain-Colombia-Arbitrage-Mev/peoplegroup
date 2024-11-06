@extends('fonts.layouts.user')
@section('site')
    | Lend | Packages
@endsection

@section('style')
    <style>
        .panel .panel-body {
            font-size: 15px;
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
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-th"></i> Invest Packages</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                @foreach($pack as $gate)
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">Invest By {{$gate->title}}</h4>
                                            </div>
                                            <div class="panel-body text-center">
                                                <p style="color: green">Invest Range: {{$gate->min_amount}}  {{$general->symbol}} - {{$gate->max_amount}} {{$general->symbol}}</p>
                                                <p style="color: blueviolet; font-weight: 700"> {{$gate->percent}} % of the Return whole of the Money every {{$gate->period}} Hours</p>
                                                <p  style="color: green">Installment {{$gate->action}} Time</p>
                                            </div>
                                            <div class="panel-footer">
                                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#buyModal{{$gate->id}}">Invest</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Buy Modal -->
                                    <div id="buyModal{{$gate->id}}" class="modal fade" role="dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Invest via <strong>{{$gate->title}}</strong></h4>
                                            </div>
                                            <form method="POST" action="{{route('lend.preview')}}">
                                                <div class="modal-body">
                                                    <p style="color: red">Referral Commision: {{$gate->lend_bonus}} %</p>
                                                    <p style="color: green"> {{$gate->percent}} % of the Return whole of the Money every {{$gate->period}} Hours.</p>
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="package_id" value="{{$gate->id}}">
                                                    <div class="form-group">
                                                        <strong class="col-md-12"> Deposit Amount ( {{$gate->min_amount}} {{$general->symbol}} - {{$gate->max_amount}} {{$general->symbol}} )</strong>
                                                        <div class="input-group">
                                                            <input type="text" name="amount" class="form-control" placeholder="Amount of Lending" required>
                                                            <span class="input-group-addon"> {{$general->currency}} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Confirm to Invest</button>
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection