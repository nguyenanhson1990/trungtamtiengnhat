<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">

        <title>@lang('admin.title') - @yield('title')</title>

        <!-- Jquery Ui Core CSS -->
        <link href="{{asset('css/admin/libs/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/admin/libs/jquery-ui.theme.min.css')}}" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('css/admin/sb-admin-2.css')}}" rel="stylesheet">
        <link href="{{asset('css/admin/component/app.css')}}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Boostrap tagsinput Core CSS -->
        <link href="{{asset('css/admin/libs/bootstrap-tagsinput.css')}}" rel="stylesheet">
        <link href="{{asset('css/admin/libs/bootstrap-tagsinput.theme.css')}}" rel="stylesheet">

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

        <!-- jQuery Ui Lib -->
        <script src="{{asset('js/admin/libs/jquery-ui.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('js/admin/sb-admin-2.js')}}"></script>

        <!-- Admin component JavaScript -->
        <script src="{{asset('js/admin/component/admin.js')}}"></script>

        <!-- Boostrap tags input Ui Lib -->
        <script src="{{asset('js/admin/libs/bootstrap-tagsinput.min.js')}}"></script>

        <!-- Ckeditor Core JavaScript -->
        <script src="{{asset('/templateEditor/ckeditor/ckeditor.js')}}"></script>

        <script>
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
        </script>
        <!-- extras JavaScript -->
        @yield('scripts')
    </body>

</html>