var modal_body;
$(document).ready(function(){
    $('.bxslider').bxSlider({
        minSlides: 1,
        maxSlides: 4,
        slideMargin: 10,
        slideWidth: 300,
        captions: true
    });
    // Keep the default modal body in a variable
    // to revert it back when 'New' is clicked
    modal_body = $('#modal-body').html();
    var url = $("#url").val();
    var upload_url = url+'/upload';

    $('#uploading').hide();

    var validateFile = function () {
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
            alert("Please upgrade your browser, because your current browser lacks some new features we need!");
            return;
        }

        var file = this.files[0];
        if (['image/png', 'image/jpeg', 'image/jpg'].indexOf(file.type) === -1) {
            alert("File type must be PNG or JPEG");
            return;
        }
        if (file.size > 5242880) {
            alert("File size must be less than 5 MB!");
            return;
        }
    }

    $("#inputFile").change(validateFile);

    $('#upload').on('click', function(){
        var title = $('#inputTitle').val();
        var params = {title: title};

        if (!$('#inputFile')[0].files.length) {
            alert('Please select a file to upload.');
            return;
        }

        $.post(upload_url, params, function (data) {
            // Upload the image if there is no error
            if (!data.error) {
                doUpload(params);
                return;
            }

            if (data.messages.Title) {
                $('#form_title').addClass('has-error');
                $('#help-block-title').html(data.messages.Title);
            } else {
                $('#form_title').addClass('has-success');
            }
        });
    });

    function doUpload(params) {
        $('#uploading').show();

        $('#inputFile').upload(upload_url, params, function(data){
            if (!data.error) {
                var html = '<a href="'+url+'/photo/'+data.id+'" class="thumbnail">';
                html += '<img src="'+url+'/img/thumbnail/'+data.thumbnail_name+'" width="90" height="30"></a>';
                $('.modal-body').html(html);
                return;
            }

            if(data.messages.Photo) {
                $('#form_photo').addClass('has-error');
                $('#help-block-photo').html(data.messages.Photo);
            } else {
                $('#form_photo').addClass('has-success');
            }
        }, function(prog, value){
            $('#prog').width(value+'%');
        });
    }

    $('#new_upload').on('click', function(){
        $('#modal-body').html(modal_body);
        $('#uploading').hide();
        $("#inputFile").change(validateFile);
    });
});

