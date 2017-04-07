<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Nui Truc Cpanel - @yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('css/admin/sb-admin-2.css')}}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

        <!-- extras Stylesheet -->
        @yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="wrapper">
            @section('navigation')
                <!-- Navigation -->
                @include('layouts.partial.admin.navigation')
            @show
            <div id="page-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('vendor/morrisjs/morris.min.js')}}"></script>
        <script src="{{asset('data/morris-data.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('js/admin/sb-admin-2.js')}}"></script>

        <!-- extras JavaScript -->
        @yield('scripts')
    </body>

</html>