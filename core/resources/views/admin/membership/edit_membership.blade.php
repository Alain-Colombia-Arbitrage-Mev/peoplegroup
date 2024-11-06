@extends('master')
@section('site-title')
    Editar membresía
@endsection
@section('style')
    <link href="{{url('/')}}/assets/admin_assets/css/spectrum.css" rel="stylesheet">
    <style>
        .pranto span{
            padding: 0px;

        }
        .pranto span input[type="text"]{
            border:none;

        }
        .pranto input{
            padding: 23px 5px;

        }
        .datepicker {
            padding: 23px 5px;
            border-radius: 4px;
            direction: ltr;
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-010">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h12><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alerta!</h12>
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
                            <div class="caption">
                                <i class="fa fa-th"></i> Editar {{$membership->tittle}}
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                                <form method="POST" action="{{route('membership.update', $membership->id)}}" enctype="multipart/form-data" autocomplete="off">
                                    {{csrf_field()}}
                                    <div class="form-group col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{ asset('assets/images/membership') }}/{{$membership->image}}" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 150px;"> </div>
                                            <div>
                                            <span class="btn btn-success btn-file">
                                            <span class="fileinput-new"> Cambiar Imagen </span>
                                            <span class="fileinput-exists"> Cambiar </span>
                                            <input type="file" name="image"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong>Nombre</strong>
                                        <input type="text" value="{{$membership->tittle}}" class="form-control" id="tittle" name="tittle" >
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong >Precio Final</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->price}}" class="form-control" id="price" name="price" >
                                            <span class="input-group-addon"> {{$general->currency}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong >Costo</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->cost}}" class="form-control" id="cost" name="cost" >
                                            <span class="input-group-addon"> {{$general->currency}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong>Porcentaje de Utilidad (Sobre la venta)</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->utility_perc}}" class="form-control" id="utility_perc" name="utility_perc" >
                                            <span class="input-group-addon"> %</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong>Porcentaje de Bono Rápido</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->quick_bonus_per}}" class="form-control" id="quick_bonus_per" name="quick_bonus_per" >
                                            <span class="input-group-addon"> %</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-md-12">
                                        <strong class="">Distribución de bono unilevel en la red</strong>
                                        <p><span class=" text-muted ">Restante a liquidar en la red despues cubrir costo, porcentaje de utilidad y porcentaje de bono rápido.</span><p>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->unilevel_perc}}" class="form-control" id="unilevel_perc" name="unilevel_perc" >
                                            <span class="input-group-addon"> %</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong >Máximo nivel de profundidad</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->max_level}}" class="form-control" id="max_level" name="max_level" >
                                            <span class="input-group-addon"> Niveles</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong >Días de gracia para actualizar membresía con reconocimiento del pago del plan actual</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->days_for_upgrade}}" class="form-control" id="days_for_upgrade" name="days_for_upgrade" >
                                            <span class="input-group-addon"> Días</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong for="status">Producto de consumo mensual</strong>
                                        <select class="form-control" name="product_id">
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}" {{ $membership->product_id == $product->id ? 'selected' : '' }}>{{$product->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong >Cantidad mínima de consumo mensual para recibir bonos</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->product_qty}}" class="form-control" id="product_qty" name="product_qty" >
                                            <span class="input-group-addon"> Unidades</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <strong for="status">Días de gracia para realizar el autoconsumo y recibir bonos</strong>
                                        <div class="input-group">
                                            <input type="text" value="{{$membership->days_for_consu}}" class="form-control" id="days_for_consu" name="days_for_consu" >
                                            <span class="input-group-addon"> Días</span>
                                        </div>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <label class=" bold">Descripción: </label>
                                        <div class="">
                                            <textarea class="form-control" name="description" id="description" rows=10>
                                            {{$membership->description}}
                                            </textarea>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <strong for="status">Estado</strong>
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $membership->status == "1" ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $membership->status == "0" ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>

                                     <div class="form-actions">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn-block btn dark"><i class="fa fa-check"></i> Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('/')}}/assets/admin_assets/spectrum.js"></script>
  <script>
      $('#base_color').spectrum({
          color: $('#base_color').val(),
          change: function (color) {
              $('#base_color_value').val(color.toHexString().slice(1));
          }
      });

      $('#sec_color').spectrum({
          rong: $('#sec_color').val(),
          change: function (rong) {
              $('#sec_color_value').val(rong.toHexString().slice(1));
          }
      });
  </script>
@endsection
