@extends('master')
@section('site-title')
    Listado de usuarios
@endsection
@section('style')
    <style>
        #imaginary_container{
            margin-top:20%; /* Don't copy this */
        }
        .stylish-input-group .input-group-addon{
            background: white !important;
        }
        .stylish-input-group .form-control{
            border-right:0;
            box-shadow:0 0 0;
            border-color:#ccc;
        }
        .stylish-input-group button{
            border:0;
            background:transparent;
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">
                Lista de Usuarios {{ $tittle_list }}
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-search"></i> BUSCAR USUARIOS</div>
                        </div>
                        <div class="portlet-body table-responsive">
                            <div class="row">
                               <div class="col-md-12">
                                   <div class="col-md-6" style="margin-bottom: 5px">
                                       <form class="form-horizontal" method="GET" action="{{route('username.search')}}">

                                           <div class="input-group stylish-input-group">
                                               <input type="text" class="form-control" name="username" required placeholder="Buscar por nombre de usuario" >
                                               <span class="input-group-addon">
                                                <button type="submit">
                                                    <span><i class="fa fa-search"></i></span>
                                                </button>
                                            </span>
                                           </div>
                                       </form>
                                   </div>

                                   <div class="col-md-6">
                                       <form class="form-horizontal" method="GET" action="{{route('email.search')}}">

                                           <div class="input-group stylish-input-group">
                                               <input type="email" class="form-control" name="email"  placeholder="Buscar por Email" required >
                                               <span class="input-group-addon">
                                                <button type="submit">
                                                    <span><i class="fa fa-search"></i></span>
                                                </button>
                                            </span>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Session::has('not_found'))
                    <div class="col-md-12">
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-user"></i> Usuario</div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h1 class="bold" style="color: red">{{ Session::get('not_found') }} <i class="fas fa-frown"></i></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else

                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-user"></i> Listado de usuarios</div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> Nombre </th>
                                        <th> Usuario </th>
                                        <th> Email</th>
                                        <th> Calular</th>
                                        <th> Saldo </th>
                                        <th> Acción </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->first_name}} {{$data->last_name}}
                                                @if($data->membership_id > 0)
                                                    <span class="badge badge-success">{{$data->membership->tittle}}</span>
                                                @elseif($data->status != 1)
                                                    <span class="badge badge-danger">Baneado</span>
                                                @else
                                                    <span class="badge badge-warning">Sin Plan</span>
                                                @endif
                                            </td>
                                            <td><b>{{$data->username}}</b></td>
                                            <td><b>{{$data->email}}</b></td>
                                            <td>{{ $data->mobile}}</td>
                                            <td>{{$general->symbol}} {{ $data->balance }}</td>
                                            <td>
                                                <a class="btn purple" href="{{route('user.view', $data->id)}}"><i class="fas fa-desktop"></i>  Ver detalle</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">{{$user->links()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif


            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

