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
                    <form role="form" method="post" id="frm-add-post" action="{{Route('contents_update',['id' => $id])}}" enctype="multipart/form-data">
                        <div class="col-lg-8">
                            {{ csrf_field() }}
                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                <label class="control-label" for="title">{{ __('admin.contents.contents_title') }} *</label>
                                <input id="title" type="text" name="title" value="{{ !empty(old('title')) ? old('title') : $contents->title}}" class="form-control">
                                <input type="hidden" name="content_type" value="1">
                            </div>
                            <div class="form-group @if($errors->has('slug')) has-error @endif">
                                <label class="control-label" for="slug">{{ __('admin.contents.contents_slug') }}</label>
                                <input id="slug" type="text" name="slug" value="{{ !empty(old('slug')) ?  old('slug') : $contents->slug }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="short_content">{{ __('admin.contents.contents_shore_desc') }}</label>
                                    <textarea id="short_content" class="short_content form-control" rows="5" name="short_content">{{ !empty(old('short_content')) ? old('short_content') : $contents->short_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="main_content">{{ __('admin.contents.contents_desc') }}</label>
                                    <textarea id="main_content" name="main_content">
                                        {{ !empty(old('main_content')) ? old('main_content') : $contents->content}}
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="btn-thumbnail">{{__('admin.contents.contents_thumbnail')}}</label>
                                <div class="preview-area">
                                    @if(!empty($contents->thumbnail))
                                        <img src="{{asset($contents->thumbnail)}}" width="100%">
                                    @endif
                                </div>
                                <label class="ask-rick has-error-upload">{{__('admin.contents.messages.error_upload')}}</label><br>
                                <label>
                                    <a href="#" id="file-upload">{{__('admin.file_upload')}}</a>&nbsp&nbsp<a href="#" id="remove-upload">{{__('admin.delete')}}</a>
                                    <input type="file" onchange="previewImage($(this));" name="thumbnail" id="btn-thumbnail" class="hide">
                                </label>
                                <label class="ask-rick"><em>{{__('admin.contents.messages.thumbnail_notify')}}</em></label>
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.contents.contents_category')}}</label><br>
                                <div class="panel panel-default scroll">
                                    <div class ="panel-body inner">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" @if(in_array(1,$contents_categories_id)) checked @endif name="category_id[]" id="category_id" value="1"> {{__('admin.contents.contents_uncategory')}}
                                            </label>
                                        </div>
                                        {{ render_category_checkbox($categories,"",0,$contents_categories_id) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('admin.contents.status')}}</label>
                                <select class="form-control" name="status" id="status">
                                    @foreach($status as $key => $item)
                                        <option @if($contents->status == $key) selected @endif value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="user_id" value="{{$contents->user_id}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="datepicker">{{ __('admin.contents.contents_og_enddate') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.end_date')}}"></i>
                                <input id="datepicker" type="text" name="end_date" value="{{ !empty(old('end_date')) ? old('end_date') : \App\Support\functions::mysql_to_date($contents->end_date)}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="og_keyword">{{ __('admin.contents.contents_og_keyword') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.og_keyword')}}"></i>
                                <input id="og_keyword" type="text" name="og_keyword" value="{{old('og_keyword')}}" class="form-control" data-role="tagsinput">
                            </div>
                            <div class="form-group">
                                <label for="og_desc">{{ __('admin.contents.contents_og_desc') }}</label>
                                <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="{{__('admin.contents.tooltip.og_desc')}}"></i>
                                <textarea class="form-control" id="og_desc" name="og_desc" rows="3" value="{{ !empty(old('og_desc')) ? old('og_desc') : $contents->og_desc}}">{{ !empty(old('og_desc')) ? old('og_desc') : $contents->og_desc}}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary btn-submit">{{__('admin.contents.edit')}}</button>
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
    <script>
        var keyword = "{{$contents->og_keyword}}";
        CKEDITOR.replace( 'main_content', options );
    </script>
    <!-- contents js -->
    <script src="{{asset('js/admin/contents/app.js')}}"></script>
@endsection