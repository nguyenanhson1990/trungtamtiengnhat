$(document).ready(function () {
    $('.alert-success, .alert-error, .alert-warning, .alert-danger').delay(1500).slideUp();

    $('[data-toggle="tooltip"]').tooltip();

    $( "#datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
    });

    //upload file image
    $('#file-upload').on('click', function(e){
        e.preventDefault();
        $('#btn-thumbnail').trigger('click');
    });
    $('#remove-upload').on('click', function(e){
        e.preventDefault();
        $('.preview-area').html('');
    });

    $('.check_all').on('click', function(e){
        $('.check_all_item').prop('checked', $(this).prop('checked'));
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

//render slugs
function slugify(text)
{
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}
