@extends('fonts.layouts.user')
@section('site')
    | Transferencia de fondos
@endsection
@section('style')
    <style>
        /*responsive for user dashboard*/
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .input-lg{
                width: 100% !important;
            }
        }
        @media only screen and (max-width: 480px) { 
            .input-lg.responsive{
                width: 100% !important;
            }
            .input-group-addon.responsive{
                font-size: 12px;
            }
            
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
            @if(Auth::user()->level !=3)
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-ebonyclay">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-th"></i> Transferencia de fondos</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p style="color: darkgreen">Comparte tus fondos con otro usuario</p>
                                    <p  style="color: darkgreen" >El Valor compartido se reflejará en la cuenta del usuario a transferir</p>
                                    <p  style="color: darkgreen" >Mínimo 10 {{$general->currency}} Pueden ser transferidos</p>
                                </div>
                            </div>

                            <div class="row">
                                <form action="{{route('store.transfer.fund')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="col-md-12 product-service md-margin-bottom-30">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control input-lg " placeholder="Usuario a transferir" id="refname" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="resu"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon responsive">TRANSFERIR</span>
                                                        <input class="form-control input-lg responsive" placeholder="Valor a transferir" name="amount" min="0" type="number" step=".01" id="inputAmount" required>
                                                        <span class="input-group-addon responsive">{{$general->currency}}</span>
                                                    </div>
                                                    <div id="showMessage">

                                                    </div>
                                                    <p style="color:red; font-weight: bold; font-size:20px;"> {{$comission->transfer_charge}}% De cargo será descontado de su saldo</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn blue-ebonyclay btn-block"> Transferir Ahora</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>

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
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('input','#refname',function() {
                var search_name = $('#refname').val();
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.user')}}",
                    data:{
                        'name': search_name ,
                        '_token' : token
                    },
                    success:function(data){
//                      console.log(data);
                        $("#resu").html(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('keyup','#inputAmount',function() {
                var inputAmount = parseFloat($('#inputAmount').val());
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.total.charge')}}",
                    data:{
                        'inputAmount': inputAmount ,
                        '_token' : token
                    },
                    success:function(data){
//                        console.log(data);
                        $("#showMessage").html(data);

                    }
                });

                $('#inputAmount').keyup(function(event){
                    var regex = /[0-9]|\./;
                    var text = $('#inputAmount').val();

                    if( !(regex.test(text))) {
                        $("#showMessage").html("<span style='color: red'>Valor no válido</span>");
                    }
                });
            });
        });
    </script>
@endsection