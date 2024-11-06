@extends('fonts.layouts.user')
@section('site')
    | Tablero
@endsection
@section('style')
    <style>
        .visual{
            color: #f7f6ff;
        }

        .pranto {
            margin-bottom: 10px;
        }

        .dashboard-stat .details .desc {
            text-align: right;
            font-size: 16px !important;
            letter-spacing: 0;
            font-weight: 300;
        }

        .column-chart {
            position: relative;
            z-index: 20;
            bottom: 0;
            left: 50%;
            width: 100%;
            height: 320px;
            margin-top: 30px;
            margin-left: -50%;
        }
        @media (min-width: 568px) {
            .column-chart {
                width: 80%;
                margin-left: -30%;
            }
        }
        @media (min-width: 768px) {
            .column-chart {
                width: 60%;
                margin-left: -30%;
            }
        }
        @media (min-width: 992px) {
            .column-chart {
                width: 30%;
                margin-left: -20%;
            }
        }
        @media (min-width: 1023px) {
            .column-chart {
                width: 36%;
                margin-left: -18%;
            }
        }
        .column-chart:before, .column-chart:after {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: calc(100% + 30px);
            height: 25%;
            margin-left: -15px;
            border-top: 1px dashed #b3b3b5;
            border-bottom: 1px dashed #b3b3b5;
        }
        .column-chart:after {
            top: 50%;
        }
        .column-chart > .legend {
            position: absolute;
            z-index: -1;
            top: 0;
        }
        .column-chart > .legend.legend-left {
            left: 0;
            width: 25px;
            height: 75%;
            margin-left: -55px;
            border: 1px solid #b3b3b5;
            border-right: none;
        }
        .column-chart > .legend.legend-left > .legend-title {
            display: block;
            position: absolute;
            top: 50%;
            left: 0;
            width: 65px;
            height: 50px;
            line-height: 50px;
            margin-top: -25px;
            margin-left: -60px;
            font-size: 28px;
            letter-spacing: 1px;
        }
        .column-chart > .legend.legend-right {
            right: 0;
            width: 100px;
            height: 100%;
            margin-right: -115px;
        }
        .column-chart > .legend.legend-right > .item {
            position: relative;
            width: 100%;
            height: 25%;
        }
        .column-chart > .legend.legend-right > .item > h3 {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 30px;
            line-height: 30px;
            margin-top: -20px;
            font-size: 16px;
            text-align: right;
        }
        .column-chart > .chart {
            position: relative;
            z-index: 20;
            bottom: 0;
            left: 50%;
            width: 98%;
            height: 100%;
            margin-left: -39%;
        }
        .column-chart > .chart > .item {
            position: relative;
            float: left;
            height: 100%;
        }
        .column-chart > .chart > .item:before {
            position: absolute;
            z-index: -1;
            content: '';
            bottom: 0;
            left: 50%;
            width: 1px;
            height: calc(100% + 15px);
            border-right: 1px dashed #b3b3b5;
        }
        .column-chart > .chart > .item > .bar {
            position: absolute;
            bottom: 0;
            left: 3px;
            width: 93%;
            height: 100%;
        }
        .column-chart > .chart > .item > .bar > span.percent {
            display: block;
            position: absolute;
            z-index: 25;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 26px;
            line-height: 26px;
            color: #fff;
            background-color: #3e50b3;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 1px;
        }
        .column-chart > .chart > .item > .bar > .item-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20%;
            color: #fff;
            background-color: #ff3081;
        }
        .column-chart > .chart > .item > .bar > .item-progress > .title {
            position: absolute;
            top: calc(50% - 13px);
            left: 50%;
            font-size: 13px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            -moz-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            transform: translateX(-50%) translateY(-50%) rotate(-90deg);
        }
        @media (min-width: 360px) {
            .column-chart > .chart > .item > .bar > .item-progress > .title {
                font-size: 16px;
            }
        }
        @media (min-width: 380px) {
            .column-chart > .chart > .item > .bar > .item-progress > .title {
                font-size: 18px;
            }
        }
        /*responsive for user dashboard*/
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .dashboard-stat .details .desc {
                display: block;
                margin-top: 20px;
            }
        }

    </style>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h3><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h3>
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
                @if(Auth::user()->paid_status == 0)
                <div class="col-md-12">
                    <div class="m-heading-1 border-dark m-bordered" style="margin-bottom:10px;  ">
                        <p> <b style="font-size:17px;"> {{Auth::user()->first_name}}, </b> {!! $charge->update_text !!} <a class="btn blue btn-outline"  href="{{route('membership.index')}}" >Comprar Plan</a></p>
                    </div>
                </div>
                @endif

                        <div class="col-md-12">
                            <div class="portlet box dark">
                                <div class="portlet-title">
                                    <div class="caption "><i class="fa fa-link"></i> https://people.grouprfg.com/register?sponsor={{Auth::user()->username}}</div>
                                </div>
                            </div>
                            <div class="portlet box dark">
                                <div class="portlet-title">
                                    <div class="caption uppercase bold"><i class="fa fa-user"></i> Acceso Rápido</div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('tree.index')}}">
                                                <div class="dashboard-stat blue">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fa fa-tree"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Mi red </div>
                                                    </div>
                                                    <a class="more" href="{{route('tree.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('profile.index')}}">
                                                <div class="dashboard-stat blue-steel">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Mi Perfil </div>
                                                    </div>
                                                    <a class="more" href="{{route('profile.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('referral.index')}}">
                                                <div class="dashboard-stat blue-chambray">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fa fa-th"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Mis referidos </div>
                                                    </div>
                                                    <a class="more" href="{{route('referral.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('fund.transfer.index')}}">
                                                <div class="dashboard-stat yellow">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fas fa-share-alt-square"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Transferir Fondos </div>
                                                    </div>
                                                    <a class="more" href="{{route('fund.transfer.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('ref.commision.index')}}">
                                                <div class="dashboard-stat purple">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="far fa-money-bill-alt"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Bonos rápidos </div>
                                                    </div>
                                                    <a class="more" href="{{route('ref.commision.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('unilevel.commision.index')}}">
                                                <div class="dashboard-stat blue-sharp">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Comisión Unilevel </div>
                                                    </div>
                                                    <a class="more" href="{{route('unilevel.commision.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('unilevel.commision.index')}}">
                                                <div class="dashboard-stat blue-sharp">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Comisión Solidario </div>
                                                    </div>
                                                    <a class="more" href="{{route('solidario.commision.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('transaction.history')}}">
                                                <div class="dashboard-stat grey-mint">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fa fa-arrow-circle-down"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Historial transacciones </div>
                                                    </div>
                                                    <a class="more" href="{{route('transaction.history')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a href="{{route('add.fund.index')}}">
                                                <div class="dashboard-stat green-jungle">
                                                    <div class="visual">
                                                        <div class="service-icon"  style="color: white">
                                                            <i class="fa fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                        </div>
                                                        <div class="desc"> Añadir Fondos </div>
                                                    </div>
                                                    <a class="more" href="{{route('add.fund.index')}}"> Ver
                                                        <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>


                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                    <div class="col-md-12" hidden>
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fas fa-chart-bar"></i> Gráfico de Transacciones</div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="myfirstchart" style="height: 250px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    </div>
                        @else

                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h3 class="text-center bold">You Game Is Over, You Can Only Withdraw Your Money  <i class="far fa-smile"></i></h3>
                            </div>
                        </div>
                    @endif


            </div>
        </div>
   @php
    $main_chart_data = "[";


    $trans = \App\Transaction::where('user_id',Auth::user()->id)
    ->orderBy('id', 'desc')->take(8)->get();

        foreach ($trans as $data){
         $main_chart_data .= "{ year: '".date('Y-m-d', strtotime($data->time))."' , value:  ".abs($data->amount)."  }".",";
        }

    $main_chart_data .= "]";

   @endphp
@endsection
@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function () {
            new Morris.Bar({
                element: 'myfirstchart',
                data: @php echo $main_chart_data  @endphp,
                xkey: 'year',
                ykeys: ['value'],
                // chart.
                labels: ['Value']
            });
        });
    </script>
@endsection

