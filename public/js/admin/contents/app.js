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
    if(keyword != "")
    {
        $('#og_keyword').tagsinput('add', keyword);
    }
});