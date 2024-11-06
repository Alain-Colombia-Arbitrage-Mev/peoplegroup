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
                Mi red
            </h3>


            @if(Auth::user()->level !=3)

            <style>
                    html, body {
                margin: 0px;
                padding: 0px;
                width: 100%;
                height: 100%;
                overflow: hidden;
                font-family: Helvetica;
            }

            #tree {
                width: 100%;
                height: 100%;
            }

            </style>


            <script type="text/javascript">
                var publicTree = @json($tree);
                console.log(publicTree);
            </script>

<script src="https:///balkangraph.com/js/latest/OrgChart.js"></script>


<div id="tree"></div>




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

<script type="text/javascript">

document.addEventListener( 'DOMContentLoaded', function( event ) {
    var nodes =  @json($tree) ;

    nodes = JSON.parse(nodes);

    for (var i = 0; i < nodes.length; i++) {
        nodes[i].afiliados = childCount(nodes[i].id);
    }

    function childCount(id) {
        let count = 0;
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].pid == id) {
                count++;
                count += childCount(nodes[i].id);
            }
        }

        return count;
    }

    OrgChart.templates.rony.afiliados = '<circle cx="60" cy="110" r="15" fill="#F57C00"></circle><text fill="#ffffff" x="60" y="115" text-anchor="middle">{val}</text>';

    var chart = new OrgChart(document.getElementById("tree"), {
        template: "rony",
        collapse: {
            level: 10
        },
        nodeBinding: {
            field_0: "name",
            field_1: "nivel",
            img_0: "img",
            afiliados: "afiliados"
        },
        nodes: nodes
    });
});

</script>
@endsection