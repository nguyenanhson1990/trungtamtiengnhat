
<form method="post" name="frmDeleteUser" class="frmDeleteUser" action="{{Route('user_destroy',['user_id' => $user_id])}}">
    {{ csrf_field() }}
    {{ __('admin.delete_confirm')}}<strong>{{$datausername}}</strong>
    <input type="hidden" value="{{$user_id}}" name="user_id">
</form>