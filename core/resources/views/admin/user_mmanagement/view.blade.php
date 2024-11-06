@extends('master')
@section('site-title')
    Detalles de usuario
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
            <div class="row">

            <div class="col-md-12">
                <div class="portlet box dark">
                    <div class="portlet-title">
                        <div class="caption uppercase bold"><i class="fa fa-user"></i> Perfil </div>
                    </div>
                    <div class="portlet-body">
                       <div class="row">
                           <div class="col-md-5">
                               <h2 class="bold">{{$user->first_name}} {{$user->last_name}} </h2>
                               <h4>{{$user->email}} </h4>
                           </div>
                           <div class="col-md-5">
                               <h3 class="bold">Saldo : {{$user->balance}} {{$general->currency}}</h3>
                               <p class="bold">Afiliado hace {{\Carbon\Carbon::parse($user->join_date)->diffInDays()}} días</p>
                           </div>
                       </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold">
                                    <i class="fa fa-desktop"></i> Detalles </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <!-- START -->
                                    <a href="{{route('user.total.trans', $user->id)}}">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                            <div class="dashboard-stat grey-cascade">
                                                <div class="visual">
                                                    <i style="color: white" class="far fa-money-bill-alt"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <span data-counter="counterup" data-value="{{App\Transaction::where('user_id', $user->id)->count() }}"></span>
                                                    </div>
                                                    <div class="desc uppercase"> Transacciones </div>
                                                </div>
                                                <div class="more">
                                                    <div class="desc uppercase bold text-center">
                                                        <span data-counter="counterup" data-value="{{$user->balance}}"></span> {{$general->currency}} En Saldo final
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- END -->
                                    <!-- START -->
                                    <a href="{{route('user.total.deposit', $user->id)}}">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                            <div class="dashboard-stat blue-chambray">
                                                <div class="visual">
                                                    <i style="color: white" class="fas fa-suitcase"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <span data-counter="counterup" data-value="{{\App\Deposit::where('user_id', $user->id)->where('status', 1)->count()}}"></span>
                                                    </div>
                                                    <div class="desc uppercase"> DEPÓSITOS </div>
                                                </div>
                                                <div class="more">
                                                    <div class="desc uppercase bold text-center">
                                                        
                                                        <span data-counter="counterup" data-value="{{\App\Deposit::where('user_id', $user->id)->where('status', 1)->sum('amount')}}"></span> {{$general->currency}} Depositados
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- END -->
                                    <!-- START -->
                                    <a href="{{route('user.total.withdraw', $user->id)}}">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                            <div class="dashboard-stat red">
                                                <div class="visual">
                                                    <i  style="color: white" class="fa fa-upload"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <span data-counter="counterup" data-value="{{\App\WithdrawTrasection::where('user_id', $user->id)->where('status', 1)->count()}}"></span>
                                                    </div>
                                                    <div class="desc uppercase">RETIROS</div>
                                                </div>
                                                <div class="more">
                                                    <div class="desc uppercase bold text-center">
                                                        <span data-counter="counterup" data-value="{{\App\WithdrawTrasection::where('user_id', $user->id)->sum('amount')}}"></span> {{$general->currency}} Retirados
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold">
                                    <i style="color: #e6fffa" class="fa fa-cogs"></i> Operaciones </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <!-- <div class="col-md-6 uppercase">
                                        <a href="{{route('add.subs.index', $user->id)}}" class="btn blue btn-lg btn-block"> <i class="fas fa-money-bill-alt"></i> Añadir / Sustraer fondos</a>
                                    </div> -->

                                    <div class="col-md-6 uppercase">
                                        <a href="{{route('user.mail.send', $user->id)}}" class="btn btn-info btn-lg btn-block"> <i class="fa fa-envelope"></i> Enviar Email  </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-cog"></i> Actualizar Perfil </div>
                            </div>
                            <div class="portlet-body">
                                <form action="{{route('user.detail.update', $user->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('put')}}

                                    <div class="row uppercase">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Nombres</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg" name="first_name" value="{{$user->first_name}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Apellidos</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg" name="last_name" value="{{$user->last_name}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Celular</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg" name="mobile" value="{{$user->mobile}}" type="text">
                                                </div>
                                            </div>
                                        </div>


                                    </div><!-- row -->

                                    <br><br>

                                    <div class="row uppercase">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Dirección</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg"  name="street_address" value="{{$user->street_address}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Ciudad</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg" name="city" value="{{$user->city}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>País</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control input-lg" name="country" value="{{$user->country}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row -->

                                    <br><br>

                                    <div class="row uppercase">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Estado</strong></label>
                                                <input name="status" data-toggle="toggle" {{ $user->status == "1" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="Activo" data-off="Bloqueado"  data-width="100%" type="checkbox">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong>Verificar Email</strong></label>
                                                <input name="emailv" data-toggle="toggle" {{ $user->emailv == "0" ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-on="Activo" data-off="Inactivo"  data-width="100%" type="checkbox">
                                            </div>
                                        </div>

                                    </div><!-- row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn green btn-block btn-lg">Actualizar</button>
                                        </div>
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

@endsection

