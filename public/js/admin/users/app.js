$(document).ready(function(){

    //modal handler

    if($('.openModel').length > 0)
    {
        $('.openModel').on('click', function(e){

            var modal_title = $(this).attr('modalTitle'),
                datausername = $(this).attr('datausername'),
                user_id = $(this).attr('datauser_id');

            $('#modal-component').find('.modal-title').html(modal_title);

            $.ajax({
                method: 'GET',
                url: get_form_delete_url,
                data: {user_id:user_id, datausername: datausername},
                dataType: 'JSON'
            }).done(function(res){
                $('#modal-component').find('.modal-body').html(res.body);

                $('#modal-component').find('.submit').on('click', function(e){
                    if($('.frmDeleteUser').length > 0){
                        $('.frmDeleteUser').submit();
                    }
                    $(this).prop('disabled', true);
                });
            });
        });
    }

});