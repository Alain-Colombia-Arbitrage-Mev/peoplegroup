@extends('fonts.layouts.user')
@section('site')
    | Soporte
@endsection
@section('style')
  <style>
      .panel-primary>.panel-heading.has-btn {
          position:  relative;
      }

      .panel-primary>.panel-heading.has-btn .the-btn {
          position:  absolute;
          right: 20px;
          top: 50%;
          transform: translateY(-50%);
      }
      .panel-heading {
          padding: 2px 15px;
      }
  </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Soporte</h3>
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading has-btn"> 
                            <h3 class="bold"> Mis tickets </h3>
                            <a href="{{route('add.new.ticket')}}" class="btn btn-warning the-btn" style="color: black ;"><b>Nuevo Ticket</b></a>
                         </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> Id Ticket </th>
                                    <th> Asunto </th>
                                    <th> Fecha </th>
                                    <th> Estado </th>
                                    <th> Acción </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $all_ticket as $key=>$data)
                                    <tr>
                                        <td>{{$data->ticket}}</td>
                                        <td><b>{{$data->subject}}</b></td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            @if($data->status == 1)
                                                <button class="btn btn-warning"> Abierto</button>
                                            @elseif($data->status == 2)
                                                <button type="button" class="btn btn-success">  Contestado </button>
                                            @elseif($data->status == 3)
                                                <button type="button" class="btn btn-info"> Respuesta de usuario </button>
                                            @elseif($data->status == 9)
                                                <button type="button" class="btn btn-danger">  Cerrado </button>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('ticket.customer.reply', $data->ticket )}}"><b>Ver</b></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {{$all_ticket->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection