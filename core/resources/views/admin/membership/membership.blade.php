@extends('master')
@section('site-title')
    Membresías
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong class="col-md-12"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alerta!</strong>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif


                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-red-sunglo">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Membresías</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    @foreach($memberships as $membership)
                                    <form method="GET" action="{{route('membership.edit', $membership->id)}}">
                                        <div class="col-md-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-center">
                                                    {{$membership->tittle}}
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><img src="{{asset('assets/images/membership')}}/{{$membership->image}}" style="width: 100%;">
                                                        </li>


                                                        <li class="list-group-item"><h4  class="btn btn-block btn-{{$membership->status == 1 ? 'success' : 'danger'}}">{{$membership->status == 1 ? 'Activo' : 'Inactivo'}}</h4></li>
                                                    </ul>
                                                </div>
                                                <div class="panel-footer">
                                                    <button type="submit" class="btn btn-primary btn-block" >
                                                    
                                                        <i class="fa fa-edit"></i>
                                                        Editar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection