<form method="post" name="frmDeleteCategory" class="frmDeleteCategory" action="{{Route('contents_destroy')}}">
    {{ csrf_field() }}
    {{ __('admin.delete_confirm')}}
    <input type="hidden" value="{{$content_id}}" name="content_id">
</form>