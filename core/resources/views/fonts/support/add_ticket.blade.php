@extends('fonts.layouts.user')
@section('site')
    | Soporte | Nuevo
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Nuevo Ticket</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <form class="form-horizontal" method="POST" action="{{route('ticket.store')}}" accept-charset="UTF-8">
                                {{csrf_field()}}
                                <div class="form-body">
                                    <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                        <label class="col-md-12 bold">Asunto: <span class="required">
                                        * </span>
                                        </label>
                                        <div class="col-md-12">
                                            <input type="text"  value="{{ old('subject') }}"  class="form-control" required name="subject" placeholder="Asunto" >
                                            @if ($errors->has('subject'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                                        <label class="col-md-12 bold">Mensaje: </label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="detail" rows="10"></textarea>
                                            @if ($errors->has('detail'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('detail') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Enviar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection