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
                            <a href="{{Route('contents_create')}}">
                                <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row pd-5">
                        <div class="col-sm-6">
                            <form class="form-inline" action="{{Route('contents_page')}}">
                                <div class="form-group">
                                    <label for="limit">{{ __('admin.shows') }}</label>
                                    <select onchange="this.form.submit();" name="limit" aria-controls="dataTables-example" class="form-control input-sm">
                                        @foreach($record_per_page as $val)
                                            <option @if($val == $limit) selected @endif value="{{$val}}">{{$val}}</option>
                                        @endforeach
                                    </select> {{ __('admin.entries') }}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{__('admin.contents.contents_title')}}</th>
                                <th class="text-center">{{__('admin.contents.contents_shore_desc')}}</th>
                                <th class="text-center">{{__('admin.contents.contents_thumbnail')}}</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1; ?>
                            @forelse($contents as $item)
                                <tr>
                                    <td>{{$stt++}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->short_content}}</td>
                                    <td><img src="{{$item->thumbnail}}" title="{{$item->title}}"></td>
                                    <td>
                                        <a href="{{Route('contents_edit',['id'=>$item->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="#" class="openModel" modalTitle="{{ __('admin.users.contents_delete') }}" data-toggle="modal"
                                                 data-target="#modal-component"
                                                 datacontent_id="{{$item->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Record empty</td>
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
            <!-- users js -->
    <script type="text/javascript">
        var get_form_delete_url = "{{ Route('contents_delete_form')  }}";
    </script>
    <script src="{{asset('js/admin/contents/app.js')}}"></script>
@endsection