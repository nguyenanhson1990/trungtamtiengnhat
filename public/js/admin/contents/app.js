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
});