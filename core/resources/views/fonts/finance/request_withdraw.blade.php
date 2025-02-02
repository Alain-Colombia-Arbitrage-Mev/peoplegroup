@extends('fonts.layouts.user')
@section('site')
    | Retirar Fondos
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
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

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row">

                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fas fa-undo"></i> Retirar Fondos</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                @foreach($gates as $gate)
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="panel-title">Retirar via{{$gate->name}}</div>
                                            </div>
                                            <div class="panel-body text-center">
                                                <img src="{{asset('assets/images/withdraw')}}/{{$gate->image}}" style="width:100%">
                                            </div>
                                            <div class="panel-footer">
                                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#buyModal{{$gate->id}}">Via {{$gate->name}} </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Buy Modal -->
                                    <div id="buyModal{{$gate->id}}" class="modal fade" role="dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Retirar via <strong>{{$gate->name}}</strong></h4>
                                            </div>
                                            <form method="POST" action="{{route('withdraw.preview.user')}}">
                                                <div class="modal-body">
                                                    {{csrf_field()}}
                                                    <div class="text-center">
                                                        <p style="color: red">Cargo por retiro: {{$gate->chargefx}} {{$general->currency}}</p>
                                                        <p>Cargo en porcentaje: {{$gate->chargepc}} %</p>
                                                        <p style="color: red">Días de procesamiento (Al menos) : {{$gate->processing_day}} Días</p>
                                                    </div>
                                                    <input type="hidden" name="gateway" value="{{$gate->id}}">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" name="amount" class="form-control" id="amount" placeholder="VALOR A RETIRAR | Mínimo {{$gate->min_amo}} {{$general->currency}}" required>
                                                            <span class="input-group-addon"> {{$general->currency}} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Si, quiero retirar</button>
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
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