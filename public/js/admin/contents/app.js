$(document).ready(function(){

    //submit form add post
    $('.btn-submit').on('click', function () {
       $('#frm-add-post').submit();
        $(this).prop('disabled',true);
    });

    //render slug
    $('#title').on('keydown', function(){
        $('#slug').val(slugify($(this).val()));
    });

    //set keyword when edit contents
    if(typeof keyword != 'undefined')
    {
        $('#og_keyword').tagsinput('add', keyword);
    }

    //modal handler

    if($('.openModel').length > 0)
    {
        $('.openModel').on('click', function(e){

            var modal_title = $(this).attr('modalTitle'),
                content_id = $(this).attr('datacontent_id');

            $('#modal-component').find('.modal-title').html(modal_title);

            $.ajax({
                method: 'GET',
                url: get_form_delete_url,
                data: {content_id:content_id,},
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

    //delete all
    $('.btn_delete_all').on('click',function(e){
        var ids = [];
        $(".check_all_item:checked").each(function(i,e){
            ids.push($(e).val());
        });
        $(this).parent().parent().find('input[name=ids]').val(JSON.stringify(ids));

        $(this).prop('disabled',true);
        $('.frmDeleteAll').submit();
    });
});