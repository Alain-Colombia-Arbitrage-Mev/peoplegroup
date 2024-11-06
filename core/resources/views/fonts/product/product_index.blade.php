@extends('fonts.layouts.user')
@section('site')
    | Productos
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
                            <div class="caption uppercase bold"><i class="fa fa-plus"></i> Comprar Productos</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">


                                @foreach($products as $product)
                                    <div class="col-md-4 col-sm-6 col-xs-12 ">
                                        <form method="POST" action="{{route('product.buy')}}">
                                            {{csrf_field()}}
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title text-center">{{$product->name}}</h4>
                                                </div>
                                                <div class="panel-body text-center">
                                                    <img src="{{asset('assets/images/product')}}/{{$product->image}}" style="width:100%">
                                                    
                                                    {!! $product->description !!}
                                                
                                                    <br>

                                                    @if (Auth::user()->price_group == 2 )
                                                        <h4 style="text-decoration:line-through" >{{round($product->price,0)}} {{$general->symbol}}</43>
                                                        <h2>{{ round($product->price2, 0)}} {{$general->symbol}}</h2>
                                                    @elseif (Auth::user()->price_group == 3 )
                                                        <h4 style="text-decoration:line-through" >{{round($product->price,0)}} {{$general->symbol}}</43>
                                                        <h2>{{ round($product->price3, 0)}} {{$general->symbol}}</h2>
                                                    @else
                                                        <h2>{{ round($product->price, 0)}} {{$general->symbol}}</h2>
                                                    @endif

                                                </div>
                                                <div class="panel-footer">
                                                
                                                <input type="hidden" value="{{$product->id}}" name="id">
                                                <input type="hidden" value="1" name="qty">
                                                <button type="submit" class="btn btn-success btn-block">Comprar</button>
                                                
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