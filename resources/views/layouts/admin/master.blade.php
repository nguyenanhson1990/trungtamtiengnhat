<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">

        <title>@lang('admin.title') - @yield('title')</title>

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
                @include('layouts.message.admin.message')
                @yield('content')
            </div>
        </div>
        @section('modal')
                @include('admin.component.modal');
                @show
        <!-- jQuery -->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('js/admin/sb-admin-2.js')}}"></script>

        <!-- Admin component JavaScript -->
        <script src="{{asset('js/admin/component/admin.js')}}"></script>

        <!-- extras JavaScript -->
        @yield('scripts')
    </body>

</html>