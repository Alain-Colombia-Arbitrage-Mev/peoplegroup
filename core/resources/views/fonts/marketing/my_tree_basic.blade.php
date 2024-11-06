@extends('fonts.layouts.user')
@section('site')
    | My | Tree
@endsection
@section('style')
    <style>
        .userInfo {
            display: none;
        }
        .user {
            width: 70px;
            text-align: center;
        }
        .page-content {
            min-height: 980px !important;
        }

        /*responsive for user dashboard*/
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .input-lg {
                width: 100%!important;
            }
        }
        @media only screen and (max-width: 480px) {
            .user img {
                width: 50px !important;
            }
            .input-lg {
                width: 278px!important;
            }
            .portlet.box.dark {
                border: none;
            }
            .popover-content{
                width: 200px;
            }
            .page-content {
                min-height: 980px !important;
            }
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="bold">
                Estructura
            </h3>


            @if(Auth::user()->level !=3)


            <script type="text/javascript">
                var publicTree = @json($tree);;
                console.log(publicTree);
            </script>

            <link rel="stylesheet" type="text/css" href="/style/tree.css">
            <script src="/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="/bower_components/d3/d3.min.js"></script>
            <script src="/scripts/jquery.hoverIntent.minified.js"></script>
            <script src="/scripts/tree.js"></script>

            <div id="tree-container"></div>
            <div id="bio"></div>


            @else

                <div class="col-md-12">
                    <div class="alert alert-danger"  role="alert">
                        <h3 class="text-center bold">No hay Referidos  <i class="far fa-smile"></i></h3>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
@section('script')

    <script>
        $('.pranto').each(function() {
            var $this = $(this);
            $this.popover({
                trigger: 'click , hover',
                placement: 'bottom',
                html: true,
                content: $this.find('.userInfo').html()
            });
        });
    </script>
@endsection