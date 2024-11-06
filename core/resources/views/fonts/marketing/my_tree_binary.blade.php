@extends('fonts.layouts.user')
@section('site')
    | Mi  Binario
@endsection

@section('style')
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto'>
@endsection

@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="bold">
                Mi Binario
            </h3>

            <div class="row">
            <div class="col-md-6">
            <h3>Short : <span class='btn btn-info'>{{$minor}}</span> points</h3>
            </div>

            <div class="col-md-6">
                <h3>Power : <span class='btn btn-info'>{{$power}}</span> points</h3>
            </div>
            </div>
            <div class="row">


            <div class="col-md-6">
            
            <p><b>Link Left</b> {{$links['left']}}</p>
            </div>
            <div class="col-md-6">
            <p><b>Link Right </b> {{$links['right']}}</p>
            </div>
            
            </div>
<div id="full-container">
<iframe data-v-082f238c="" src="http://oxigeno.local/binary/visor/?root={{$root}}" height="500" width="100%" title="net"></iframe>
</div>
@endsection