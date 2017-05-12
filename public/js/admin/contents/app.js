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

    //action click
    $('.btn_action').on('click',function(e){
        var ids = [];
        $(".check_all_item:checked").each(function(i,e){
            ids.push($(e).val());
        });
        $(this).parent().parent().find('input[name=ids]').val(JSON.stringify(ids));
    });
});