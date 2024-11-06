@extends ('fonts.layouts.blog_master')
@section('site')
    | 404
@endsection
@section('style')

       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
       <script src="//code.jquery.com/jquery-1.11.1.min.js"></script><link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        body {

            background-color:white;
            background-attachment:scroll;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            line-height:5px;
        }
        .display-1 {text-align:center;color:#e1b7b7;}
        .display-1 .fa {animation:fa-spin 5s infinite linear;}
        .display-3 {text-align:center;color:#df726a;}
        .lower-case {text-align:center;}
        .container-fluid{
            margin-top: 20px;
        }
    </style>

@endsection
@section('content')


    <div class="wrapper">
        <div class="container-fluid" id="top-container-fluid-nav">
            <div class="container">
                <!---- for nav container ----->
            </div>
        </div>


        <div class="container-fluid" id="body-container-fluid">
            <div class="container">
                <!---- for body container ---->


                <div class="jumbotron  text-center">
                    <h1 class="display-1">4<i class="fa  fa-spin fa-cog fa-3x"></i> 4</h1>
                    <h1 class="display-3">ERROR</h1>
                    <a class="btn btn-primary" href="{{url('/')}}">Volver al Inicio</a>
                </div>

                <!-------mother container middle class------------------->


            </div>
        </div>


        <div class="container-fluid" id="footer-container-fluid">
            <div class="container">
                <!---- for footer container ---->
            </div>
        </div>



    </div>
@endsection