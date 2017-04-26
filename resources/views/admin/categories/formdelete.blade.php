
<form method="post" name="frmDeleteCategory" class="frmDeleteCategory" action="{{Route('category_destroy')}}">
    {{ csrf_field() }}
    {{ __('admin.delete_confirm')}}<strong>{{$category_name}}</strong>
    <input type="hidden" value="{{$category_id}}" name="category_id">
</form>