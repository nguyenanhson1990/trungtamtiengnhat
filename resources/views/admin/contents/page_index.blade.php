@extends('layouts.admin.master')
@section('title','Home Page')
@section('styles')
        <!-- Custom Css -->
<link href="{{asset('css/admin/contents/content.css')}}" rel="stylesheet" type="text/css">
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
                            {{__('admin.contents.contents_page_list')}}
                        </div>
                        <div class="col-sm-2 text-right">
                            <a href="{{Route('contents_create',['type' => 1])}}">
                                <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row pd-5">
                        <form class="form-inline" action="{{Route('contents_page')}}">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="limit">{{ __('admin.shows') }}</label>
                                    <select onchange="this.form.submit();" name="limit" aria-controls="dataTables-example" class="form-control input-sm">
                                        @foreach($record_per_page as $val)
                                            <option @if($val == $limit) selected @endif value="{{$val}}">{{$val}}</option>
                                        @endforeach
                                    </select> {{ __('admin.entries') }}
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select  id="category_id" onchange="this.form.submit();" name="category_id" aria-controls="dataTables-example" class="form-control input-sm">
                                        <option value="">--{{__('admin.contents.contents_category')}}--</option>
                                        {{ render_multi_menu($categories,"",0,Request::get('category_id')) }}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select  id="status_id" onchange="this.form.submit();" name="status_id" aria-controls="dataTables-example" class="form-control input-sm">
                                        <option value="">--{{__('admin.contents.status')}}--</option>
                                        @foreach($status as $key => $val)
                                            <option @if($key == $status_id) selected @endif value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select onchange="this.form.submit();" name="trashed" aria-controls="dataTables-example" class="form-control input-sm">
                                        <option value="">--{{__('admin.history')}}--</option>
                                        @foreach($trashed as $key => $val)
                                            <option @if($key == Request::get('trashed')) selected @endif value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="col-sm-2">
                            <form name="frmDeleteAll" class="frmDeleteAll" @if(Request::get('trashed') == 1) method="get" @else method="post" @endif  action="@if(Request::get('trashed') == 1) {{Route('delete_permanly')}} @else {{Route('contents_destroy')}} @endif">
                                {{ csrf_field() }}
                                <input type="hidden" name="ids">
                                <div class="pull-right">
                                    <button class="btn btn-danger btn_delete_all">{{__('admin.delete_all')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" width="20">#</th>
                                <th class="text-center" width="150">{{__('admin.contents.contents_title')}}</th>
                                <th class="text-center" width="200">{{__('admin.contents.contents_shore_desc')}}</th>
                                <th class="text-center" width="100">{{__('admin.contents.contents_thumbnail')}}</th>
                                <th class="text-center" width="100">{{__('admin.contents.status')}}</th>
                                <th class="text-center" width="50">Action</th>
                                <th class="text-center" width="50">
                                    <input type="checkbox" class="check_all"/>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1; ?>
                            @forelse($contents as $item)
                                <tr>
                                    <td>{{$stt++}}</td>
                                    <td>{{str_limit($item->title,150, '...')}}</td>
                                    <td>
                                        {!! str_limit($item->short_content,200,'...') !!}
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($item->thumbnail))
                                            <img src="{{ Image::url(asset($item->thumbnail),100,88,array('crop','grayscale')) }}" title="{{$item->title}}">
                                        @else
                                            <img src="{{ asset('uploads/no-image.png') }}" title="{{$item->title}}">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 2)
                                            <a href="{{Route('contents_change_status', ['status' => 1,'id' => $item->id])}}"><i class="fa fa-pause-circle fa-lg" aria-hidden="true"></i></a>
                                            @endif
                                        @if($item->status == 1)
                                            <a href="{{Route('contents_change_status', ['status' => 2,'id' => $item->id])}}"><i class="fa fa-play-circle-o fa-lg" aria-hidden="true"></i></a>
                                            @endif
                                    </td>
                                    <td class="text-center">
                                        @if(Request::get('trashed') == 1)
                                            <a href="{{Route('contents_restore',['id'=>$item->id])}}"><i class="fa fa-refresh" aria-hidden="true"></i></a> |
                                            <a onclick="javascript:return confirm('{{ __('admin.contents.messages.delete_permanly') }}');" href="{{Route('delete_permanly',['id'=>$item->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{Route('contents_edit',array_merge(Request::all(),['id'=>$item->id]))}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="#" class="openModel" modalTitle="{{ __('admin.contents.contents_delete') }}" data-toggle="modal"
                                                         data-target="#modal-component"
                                                 datacontent_id="{{$item->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endif
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="check_all_item" value="{{$item->id}}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Record empty</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            {{ $contents->appends(request()->input())->links() }}
                        </div>
                    </div>
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
        <script type="text/javascript">
            var get_form_delete_url = "{{ Route('contents_delete_form')  }}";
        </script>
        <script src="{{asset('js/admin/contents/app.js')}}"></script>
    @endsection