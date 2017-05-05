$(document).ready(function () {
    $('.alert-success, .alert-error, .alert-warning, .alert-danger').delay(1500).slideUp();

    $('[data-toggle="tooltip"]').tooltip();

    $( "#datepicker" ).datepicker();

    //upload file image
    $('#file-upload').on('click', function(e){
        e.preventDefault();
        $('#btn-thumbnail').trigger('click');
    });
    $('#remove-upload').on('click', function(e){
        e.preventDefault();
        $('.preview-area').html('');
    });
});

function previewImage(input){
    var preview = $("<img>",{"class":'preview-image',"src":"", "width":'100%'}),
        file = $(input)[0].files[0],
        reader = new FileReader(),
        match_file_type = ['image/jpeg','image/jpg','image/png','image/JPEG','image/JPG','image/PNG'];

    //check if match file type
    if(match_file_type.indexOf(file.type) != -1)
    {
        reader.onload = function(e)
        {
            preview[0].src = e.target.result;
        }

        if(file)
        {
            reader.readAsDataURL(file);
            $('.preview-area').html('').append(preview);
        }else{
            preview[0].src = "";
        }
    }else{
        $('.preview-area').html('');
        $('.has-error-upload').show().delay(1500).slideUp();
    }

}