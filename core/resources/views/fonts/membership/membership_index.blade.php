@extends('fonts.layouts.user')
@section('site')
    | Membresías
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

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="row">

                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-plus"></i> Membresías</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">


                                @foreach($memberships as $membership)
                                    <div class="col-md-4 col-sm-6 col-xs-12 ">
                                        <form method="POST" action="{{route('membership.buy')}}">
                                            {{csrf_field()}}
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" @if(Auth::user()->membership_id == $membership->id) style="background:#AEC800"@endif>
                                                    <h4 class="panel-title text-center">{{$membership->tittle}}</h4>
                                                </div>
                                                <div class="panel-body text-center">
                                                    <img src="{{asset('assets/images/membership')}}/{{$membership->image}}" style="width:100%">
                                                    
                                                    {!! $membership->description !!}
                                                
                                                    <br>

                                                    @if ($remaining_days > 0 && $membership->id > Auth::user()->membership_id)

                                                        <h4 style="text-decoration:line-through" >{{round($membership->price,0)}} {{$general->symbol}}</43>
                                                        <h2>{{ round($membership->price  - Auth::user()->membership->price, 0)}} {{$general->symbol}}</h2>
                                                    @else

                                                        <h2>{{ round($membership->price, 0)}} {{$general->symbol}}</h2>

                                                    @endif

                                                </div>
                                                <div class="panel-footer">
                                                @if (Auth::user()->membership_id == 0)
                                                <input type="hidden" value="{{$membership->id}}" name="id">
                                                <button type="submit" class="btn btn-success btn-block">Comprar {{$membership->tittle}}</button>
                                                @elseif($membership->id < Auth::user()->membership_id)
                                                <button type="submit" class="btn btn-warning btn-block" disabled>No disponible</button>
                                                @elseif(Auth::user()->membership_id == $membership->id)
                                                <button type="submit" class="btn btn-success btn-block" style="background:#AEC800" disabled><strong>Activa desde {{Auth::user()->membership_date}}</strong></button>
                                                @else
                                                <input type="hidden" value="{{$membership->id}}" name="id">
                                                <button type="submit" class="btn btn-success btn-block">Actualizar a {{$membership->tittle}}</button>
                                                @endif
                                                
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                    
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@endsection


@section('script')

<script type="text/javascript">

$( document ).ready(function() {
    
    var heights = $(".well2").map(function() {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    $(".well2").height(maxHeight);
});

</script>

@endsection