@extends('master')
@section('site-title')
    Configuración bonos y cargos
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-010">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h12><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h12>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
 
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Comisiones y cargos
                            </div>
                            <div class="tools">
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form method="POST" action="{{route('commission.update', $charge->id)}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-body">
                                    

                                    <h3 class="bold col-md-12">Porcentajes de comisión bonos por ingreso</h3>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12 ">Nivel 1:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level1_bonus"  value="{{$charge->level1_bonus}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 2:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" step=".01" class="form-control" required name="level2_bonus"  value="{{$charge->level2_bonus}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 3:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level3_bonus"  value="{{$charge->level3_bonus}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 4:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level4_bonus"  value="{{$charge->level4_bonus}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 5:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level5_bonus"  value="{{$charge->level5_bonus}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>



                                    <h3 class="bold col-md-12">Porcentajes de comisión bonos por solidario</h3>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12 ">#1 Upline:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level1_consu"  value="{{$charge->level1_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12 ">#1 Socio:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level1_consu"  value="{{$charge->level1_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12 ">#2 Socio:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level1_consu"  value="{{$charge->level1_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>




                                    <h3 class="bold col-md-12">Porcentajes de comisión bonos por consumo</h3>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12 ">Nivel 1:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level1_consu"  value="{{$charge->level1_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 2:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level2_consu"  value="{{$charge->level2_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 3:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level3_consu"  value="{{$charge->level3_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 4:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level4_consu"  value="{{$charge->level4_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="col-md-12">Nivel 5:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="level5_consu"  value="{{$charge->level5_consu}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <h3 class="bold col-md-12">Decisión bono huérfano</h3>

                                    <div class="form-group col-md-12">
                                        <strong class="col-md-12 ">Que hacer con bono liquidado de usuario que no hizo su consumo mensual y el pago fue retenido
                                        </strong>
                                        <div class="col-md-12">
                                            <input name="rest_bonus_for" data-toggle="toggle" {{ $charge->rest_bonus_for == "0" ? 'checked' : '' }} data-onstyle="success" data-offstyle="success" data-on="Liquidar a próximo afiliado de compresión dinámica" data-off="Generar ingreso administrativo"  data-width="100%" type="checkbox">
                                        </div>
                                    </div>

                                    <h3 class="bold col-md-12">Cargos</h3>

                                    <div class="form-group col-md-6">
                                        <strong class="col-md-12 ">Cargo de transferencia usuario a usuario:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="transfer_charge"  value="{{$charge->transfer_charge}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <strong class="col-md-12">Cargo por retiro:
                                        </strong>
                                        <div class="input-group">
                                            <input type="number" step=".01" class="form-control" required name="withdraw_charge"  value="{{$charge->withdraw_charge}}">
                                            <span class="input-group-addon" id="start-date"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <strong class="col-md-12 ">Mensaje en tablero para usuario sin plan activo:
                                        </strong>
                                        <div class="">
                                            <textarea class="form-control" name="update_text" rows="5">{!! $charge->update_text !!}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn-block btn blue"><i class="fa fa-check"></i> Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->

                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

