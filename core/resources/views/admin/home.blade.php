@extends('master')
@section('site-title')
Tablero de Administración
@endsection
@section('style')
<style>
   .visual{
   color: #f7f6ff;
   }
   .dashboard-stat .details .number{
   font-size: 2.5rem!important;
   color: white;
   font-weight: bold;
   text-shadow: 1px 0.5px black;
   
   }
   .pranto{
   margin-bottom: 10px;
   }
   .dashboard-stat .details .desc {
   text-align: right;
   font-size: 14px !important;
   letter-spacing: 0;
   font-weight: 300;
   }
   .pranto .visual svg{
   font-size: 14px;
   }
   .column-chart {
   position: relative;
   z-index: 20;
   bottom: 0;
   left: 50%;
   width: 100%;
   height: 320px;
   margin-top: 40px;
   margin-left: -50%;
   }
   @media (min-width: 568px) {
   .column-chart {
   width: 80%;
   margin-left: -40%;
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
   width: 40%;
   margin-left: -20%;
   }
   }
   @media (min-width: 1024px) {
   .column-chart {
   width: 70%;
   margin-left: -35%;
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
   border-top: 1px dashed #b4b4b5;
   border-bottom: 1px dashed #b4b4b5;
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
   border: 1px solid #b4b4b5;
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
   .column-chart > .legend.legend-right > .item > h4 {
   display: block;
   position: absolute;
   top: 0;
   right: 0;
   width: 100px;
   height: 40px;
   line-height: 40px;
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
   margin-left: -49%;
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
   border-right: 1px dashed #b4b4b5;
   }
   .column-chart > .chart > .item > .bar {
   position: absolute;
   bottom: 0;
   left: 3px;
   width: 94%;
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
   background-color: #3e50b4;
   font-size: 14px;
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
   background-color: #257db9;
   }
   .column-chart > .chart > .item > .bar > .item-progress > .title {
   position: absolute;
   top: calc(50% - 13px);
   left: 50%;
   font-size: 14px;
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
   @media (min-width: 480px) {
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



/* .tree {
  background: url("./assets/images/tree.png") no-repeat center;
  width: 300px;
  height: 250px;
} */
.tree {
  background: url('http://oxigeno.local/assets/images/tree.png') no-repeat bottom; 
  /* width: 300px;
  height: 250px; */
  background-clip:border-box;
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
      @if (Session::has('message'))
      <div class="alert alert-danger">{{ Session::get('message') }}</div>
      @endif
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box dark">
               <div class="portlet-title">
                  <div class="caption uppercase bold"><i class="far fa-money-bill-alt"></i> Resumen de transacciones</div>
               </div>
               <div class="portlet-body">
                  <div class="row">
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat tree">
                           <div class="visual">
                              <i class="fas fa-lock-open"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::where('user_id', 2)->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Fondos Administrativos</div>
                           </div>
                           <a class="more" href="{{route('user.total.trans', 2)}}"> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat yellow-gold ">
                           <div class="visual">
                              <i class="fas fa-retweet"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::where('user_id', 1)->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Wallet de Reserva</div>
                           </div>
                           <a class="more" href="{{route('user.total.trans', 1)}}"> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat tree">
                           <div class="visual">
                              <i class="fas fa-lock"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [13, 14])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Costos Operativos</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat blue-chambray">
                           <div class="visual">
                              <i class="fas fa-stopwatch"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [17, 18])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Utilidades Venta</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat green-haze">
                           <div class="visual">
                              <i class="fas fa-spinner"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::where('user_id', 2)->whereIn('type', [4,5,6,19,20])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Ingresos por bonos</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat tree">
                           <div class="visual">
                              <i class="fas fa-lock"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [10])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Cargos de Depósitos</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat green">
                           <div class="visual">
                              <i class="fas fa-stopwatch"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [12])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Cargos de Tranferencias</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat tree">
                           <div class="visual">
                              <i class="fas fa-link"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [11])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Cargos de Retiro</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat tree">
                           <div class="visual">
                              <i class="fas fa-money-bill-alt"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\User::where('id', '>', 2)->sum('balance')}}">0 </span> {{$general->symbol}}
                              </div>
                              <div class="desc"> Fondos de usuarios</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat green-jungle">
                           <div class="visual">
                              <i class="far fa-credit-card"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{ \App\Deposit::where('status', 1)->sum('amount') + \App\Deposit::where('status', 1)->sum('trx_charge')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Total Fondos añadidos</div>
                           </div>
                           <a class="more" href="{{route('index.deposit.user')}}"> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat  tree">
                           <div class="visual">
                              <i class="fas fa-link"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [4])->whereNotIn('user_id', [1,2])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Bonos Rápidos Pagados</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                     <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat  blue">
                           <div class="visual">
                              <i class="fas fa-spinner"></i>
                           </div>
                           <div class="details">
                              <div class="number">
                                 <span data-counter="counterup" data-value="{{\App\Transaction::whereIn('type', [5])->whereNotIn('user_id', [1,2])->sum('amount')}}">0</span> {{$general->symbol}}
                              </div>
                              <div class="desc">Bonos Unilevel Pagados</div>
                           </div>
                           <a class="more" href=""> Ver más
                           <i class="m-icon-swapright m-icon-white"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row" hidden>
         <div class="col-md-12">
            <div class="portlet box dark">
               <div class="portlet-title">
                  <div class="caption uppercase bold"><i class="fas fa-chart-bar"></i> Gráfica de actividad de la red</div>
               </div>
               <div class="portlet-body">
                  <div class="row">
                     <div class="text-center text-uppercase">
                        <h2>Actividad</h2>
                     </div>
                     <!-- //.text-center -->
                     <div class="column-chart">
                        <div class="legend legend-left hidden-xs">
                           <h3 class="legend-title">Usuario</h3>
                        </div>
                        <!-- //.legend -->
                        <div class="legend legend-right hidden-xs">
                           <div class="item">
                              <h4></h4>
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <h4></h4>
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <h4></h4>
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <h4></h4>
                           </div>
                           <!-- //.item -->
                        </div>
                        <!-- //.legend -->
                        @php
                        $today_user = \App\User::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->count();
                        $today_add_fund = \App\Deposit::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->count();
                        $today_withdraw = \App\WithdrawTrasection::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->count();
                        $today_icome = \App\Income::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->count();
                        $today_user_balance_transfer = \App\Transaction::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->where('type',3)->count();
                        $today_user_ticket = \App\Ticket::whereRaw('DATE(created_at) = CURRENT_DATE', \Carbon\Carbon::today())->count();
                        $today_subscribe = 0;
                        @endphp
                        <div class="chart clearfix">
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="Today User Join">{{$today_user == 0 ? 40 : $today_user}}</span>
                                 <div class="item-progress" data-percent="{{$today_user == 0 ? 40 : $today_user}}">
                                    <span class="title">Nuevos usuarios</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="Today Deposit Number">{{$today_add_fund == 0 ? 65 : $today_add_fund}}</span>
                                 <div class="item-progress" data-percent="{{$today_add_fund == 0 ? 65 : $today_add_fund}}">
                                    <span class="title">Depósitos</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="Today Withdraw Number">{{$today_withdraw == 0 ? 45 : $today_withdraw}}</span>
                                 <div class="item-progress" data-percent="{{$today_withdraw == 0 ? 45 : $today_withdraw}}">
                                    <span class="title">Retiros</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="Today Income Row">{{$today_icome == 0 ? 75 : $today_icome}}</span>
                                 <div class="item-progress" data-percent="{{$today_icome == 0 ? 75 : $today_icome}}">
                                    <span class="title">Ingresos</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="Today Balance Transfer"> {{$today_user_balance_transfer == 0 ? 55 : $today_user_balance_transfer  }}</span>
                                 <div class="item-progress" data-percent="{{$today_user_balance_transfer == 0 ? 55 : $today_user_balance_transfer }}">
                                    <span class="title">Transferencias internas</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip"  title="User Ticket">{{$today_user_ticket == 0 ? 25 : $today_user_ticket}}</span>
                                 <div class="item-progress"  data-percent="{{$today_user_ticket == 0 ? 25 : $today_user_ticket}}">
                                    <span class="title">Soporte</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                           <div class="item">
                              <div class="bar">
                                 <span class="percent"  data-toggle="tooltip" title="Today Subscribe">{{$today_subscribe == 0 ? 85 : $today_subscribe}}</span>
                                 <div class="item-progress" data-percent="{{$today_subscribe == 0 ? 85 : $today_subscribe}}">
                                    <span class="title">Compra de productos</span>
                                 </div>
                                 <!-- //.item-progress -->
                              </div>
                              <!-- //.bar -->
                           </div>
                           <!-- //.item -->
                        </div>
                        <!-- //.chart -->
                     </div>
                     <!-- //.column-chart -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function(){
       columnChart();
   
       function columnChart(){
           var item = $('.chart', '.column-chart').find('.item'),
               itemWidth = 100 / item.length;
           item.css('width', itemWidth + '%');
   
           $('.column-chart').find('.item-progress').each(function(){
               var itemProgress = $(this),
                   itemProgressHeight = $(this).parent().height() * ($(this).data('percent') / 100);
               itemProgress.css('height', itemProgressHeight);
           });
       };
   });
</script>
<script>
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();
   });
</script>
@endsection