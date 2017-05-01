$(document).ready(function(){

    //submit form add post
    $('.btn-submit').on('click', function () {
       $('#frm-add-post').submit();
        $(this).prop('disabled',true);
    });
});