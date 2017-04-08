@extends('layouts.admin.master')
@section('title','Home Page')
@section('styles')
    <!-- Custom Css -->
    <link href="{{asset('css/admin/user/user.css')}}" rel="stylesheet" type="text/css">
    @endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{__('admin.nav.user_management')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('admin.users.user_list')}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row pd-5">
                            <div class="col-sm-6">
                                <form class="form-inline" action="{{Route('users')}}">
                                    <div class="form-group">
                                        <label for="limit">{{ __('admin.shows') }}</label>
                                        <select onchange="this.form.submit();" name="limit" aria-controls="dataTables-example" class="form-control input-sm">
                                            @foreach($record_per_page as $val)
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select> {{ __('admin.entries') }}
                                    </div>
                                </form>
                            </div>
                            <form class="form-inline" action="#">
                                <div class="col-sm-6 text-right">
                                    <div class="form-group">
                                        <label for="keyword">{{__('admin.search')}}</label>
                                        <input type="text" name="keyword" class="form-control" id="keyword" placeholder="">
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
@endsection