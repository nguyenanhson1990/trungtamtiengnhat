$(document).ready(function(){

    //modal handler

    if($('.openModel').length > 0)
    {
        $('.openModel').on('click', function(e){

            var modal_title = $(this).attr('modalTitle'),
                cat_name = $(this).attr('datacatname'),
                cat_id = $(this).attr('datacat_id');

            $('#modal-component').find('.modal-title').html(modal_title);

            $.ajax({
                method: 'GET',
                url: get_form_delete_url,
                data: {cat_id:cat_id, cat_name: cat_name},
                dataType: 'JSON'
            }).done(function(res){
                $('#modal-component').find('.modal-body').html(res.body);

                $('#modal-component').find('.submit').on('click', function(e){
                    if($('.frmDeleteCategory').length > 0){
                        $('.frmDeleteCategory').submit();
                    }
                    $(this).prop('disabled', true);
                });
            });
        });
    }

});