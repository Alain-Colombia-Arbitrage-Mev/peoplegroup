@extends('fonts.layouts.user')
@section('site')
    | Añadir | Fondos
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


            @if(Auth::user()->level !=3)

            <div class="row">

                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-plus"></i> Recargar fondos</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">


                                @foreach($gates as $gate)
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">Medio de pago  {{$gate->name}}</h4>
                                            </div>
                                            <div class="panel-body text-center">
                                                <img src="{{asset('assets/images/gateway')}}/{{$gate->gateimg}}" style="width:100%">
                                            </div>
                                            <div class="panel-footer">
                                                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#buyModal{{$gate->id}}">Seleccionar {{$gate->name}} </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Buy Modal -->
                                    <div id="buyModal{{$gate->id}}" class="modal fade" role="dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Añadir fondos via <strong>{{$gate->name}}</strong></h4>
                                            </div>
                                            <form method="POST" action="{{route('buy.preview')}}">
                                                <div class="modal-body">
                                                    <p style="color: red"> Cargo : {{$gate->chargepc}} %</p>
                                                    <div id="resu"></div>
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="gateway" value="{{$gate->id}}">
                                                    <div class="form-group">
                                                        <strong class="col-md-12">Rango de depósito ( {{$gate->minamo}} - {{$gate->maxamo}} )</strong>
                                                        <div class="input-group">
                                                            <input type="text" name="amount" class="form-control amount" id="inputAmountAdd" placeholder="valor a añadir" required>
                                                            <span class="input-group-addon"> {{$general->currency}} </span>
                                                        </div>
                                                        <div id="showMessage">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info">Si, Agregar fondos!</button>
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