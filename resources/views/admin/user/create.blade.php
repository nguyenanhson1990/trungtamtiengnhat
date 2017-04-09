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
                    <div class="row">
                        <div class="col-sm-10">
                            {{__('admin.users.user_add')}}
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error  }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <form role="form" method="post" action="{{Route('store')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">{{ __('admin.users.email') }}</label>
                                <input id="email" type="text" name="email" value="{{old('email')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="first_name">{{ __('admin.users.first_name') }}</label>
                                <input id="first_name" type="text" name="first_name" value="{{old('first_name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">{{ __('admin.users.last_name') }}</label>
                                <input id="last_name" type="text" name="last_name" value="{{old('last_name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">{{ __('admin.users.password') }}</label>
                                <input id="password" type="password" name="password" value="{{old('password')}}" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <a href="{{Route('users')}}">
                                    <button type="button" class="btn btn-danger">Quay lại</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
@endsection