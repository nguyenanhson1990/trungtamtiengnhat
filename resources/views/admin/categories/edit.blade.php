@extends('layouts.admin.master')
@section('title','Home Page')
@section('styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{__('admin.nav.content_management_categories')}}</h1>
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
                            {{__('admin.category.category_add')}}
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
                        <form role="form" method="post" action="{{Route('category_update',['id' => $category->id])}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>{{__('admin.category.parent')}}</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">{{__('admin.category.root')}}</option>
                                    {{ render_multi_menu($parent_cat,"",0, !empty(old('parent_id')) ? old('parent_id') : $category->parent_id ) }}
                                </select>
                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="control-label" for="name">{{ __('admin.category.category_name') }}</label>
                                <input id="name" type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $category->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="desc">{{ __('admin.category.category_desc') }}</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3" value="{{ !empty(old('desc')) ? old('desc') : $category->desc }}">{{ !empty(old('desc')) ? old('desc') : $category->desc }}</textarea>
                            </div>
                            <input type="hidden" name="limit" value="{{Request::get('limit')}}">
                            <input type="hidden" name="page" value="{{Request::get('page')}}">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <a href="{{Route('categories')}}">
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