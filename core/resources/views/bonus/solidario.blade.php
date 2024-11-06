@extends('fonts.layouts.user')
@section('site')
    | Comisión | Solidario
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Comisión Solidario</h3>
        <!-- redimir bono -->
            <div>

            <p>Tienes un total de <b>({{$directs}})</b> Socios Directos en tu red</p>
            <form method="POST" action="{{route('solidario.redeem')}}">
            {{csrf_field()}}
            <button type="submit" class="btn btn-success btn-block">Redimir</button>

            </form>


            </div>
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
                                    <th width="10%"> # </th>
                                    <th> Fecha </th>
                                    <th> Descripción </th>
                                    <th> Estado </th>
                                    <th> Valor </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($income as $key => $data)
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> {{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }} </td>
                                    <td> {{$data->description}} </td>
                                    <th> 
                                    @if($data->status == 1)
                                        <span class="badge badge-success">Pagada</span>
                                    @elseif($data->status == 2)
                                        <span class="badge badge-danger">Pérdida de bono por no realizar consumo mínimo</span>
                                    @else
                                        <span class="badge badge-warning">Pendiente, debe realizar consumo mínimo</span>
                                    @endif
                                    </th>
                                    <td> {{$data->amount}}  {{$general->symbol}} </td>  
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
