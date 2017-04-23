@if(Session::has('flash_notify.message'))
<div class="alert alert-{{Session::get('flash_notify.level')}}">
    {{ Session::get('flash_notify.message') }}
</div>
    @endif