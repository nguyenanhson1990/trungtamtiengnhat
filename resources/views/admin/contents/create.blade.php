@extends('layouts.admin.master')
@section('title','Home Page')
@section('styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{__('admin.nav.content_management_page')}}</h1>
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
                            {{__('admin.contents.contents_add')}}
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
                    <form role="form" method="post" id="frm-add-post" action="{{Route('contents_store')}}">
                        <div class="col-lg-8">
                                {{ csrf_field() }}
                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                    <label class="control-label" for="title">{{ __('admin.contents.contents_title') }} *</label>
                                    <input id="title" type="text" name="title" value="{{old('title')}}" class="form-control">
                                </div>
                                <div class="form-group @if($errors->has('slug')) has-error @endif">
                                    <label class="control-label" for="slug">{{ __('admin.contents.contents_slug') }}</label>
                                    <input id="slug" type="text" name="slug" value="{{old('slug')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="short_content">{{ __('admin.contents.contents_shore_desc') }}</label>
                                    <textarea id="short_content" name="short_content">
                                        {{old('short_content')}}
                                    </textarea>
                                    @ckeditor('short_content',['height' => 100])
                                </div>
                                <div class="form-group">
                                    <label for="content">{{ __('admin.contents.contents_desc') }}</label>
                                    <textarea id="content" name="content">
                                        {{old('content')}}
                                    </textarea>
                                    @ckeditor('content')
                                </div>
                        </div>

                        <div class="col-lg-4">
                            @if($type == 2)
                            <div class="form-group">
                                <label>{{__('admin.contents.contents_category')}}</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">{{__('admin.contents.contents_category')}}</option>
                                    {{ render_multi_menu($categories,"",0,old('parent_id')) }}
                                </select>
                            </div>
                                @endif
                            <div class="form-group">
                                <label for="status">{{__('admin.contents.status')}}</label>
                                <select class="form-control" name="status" id="status">
                                    @foreach($status as $key => $item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group @if($errors->has('end_date')) has-error @endif">
                                <label class="control-label" for="datepicker">{{ __('admin.contents.contents_og_enddate') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.end_date')}}"></i>
                                <input id="datepicker" type="text" name="end_date" value="{{old('end_date')}}" class="form-control">
                            </div>
                            <div class="form-group @if($errors->has('og_keyword')) has-error @endif">
                                <label class="control-label" for="og_keyword">{{ __('admin.contents.contents_og_keyword') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.og_keyword')}}"></i>
                                <input id="og_keyword" type="text" name="og_keyword" value="{{old('og_keyword')}}" class="form-control" data-role="tagsinput">
                            </div>
                            <div class="form-group">
                                <label for="og_desc">{{ __('admin.contents.contents_og_desc') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.og_desc')}}"></i>
                                <textarea class="form-control" id="og_desc" name="og_desc" rows="3" value="{{old('og_desc')}}">{{old('og_desc')}}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary btn-submit">{{__('admin.contents.publish')}}</button>
                                <button type="reset" class="btn btn-warning">{{__('admin.reset')}}</button>
                                <a href="{{Route('contents_page')}}">
                                    <button type="button" class="btn btn-danger">{{__('admin.back')}}</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
@endsection
@section('scripts')
    <!-- contents js -->
    <script src="{{asset('js/admin/contents/app.js')}}"></script>
@endsection