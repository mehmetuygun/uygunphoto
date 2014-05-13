$(document).ready(function(){

    var error_type = $("#error_type").val();
    var valid = true;
    var url = $("#url").val();
    var upload_link = url+'/upload';
    var error_title_length;
    var modal_body = $('#modal-body').html();
    var new_upload = $('#new_upload').val();

    $('#uploading').hide();

    $("#inputFile").change(function() {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            var fsize = $('#inputFile')[0].files[0].size;
            var ftype = $('#inputFile')[0].files[0].type;
            var fname = $('#inputFile')[0].files[0].name;
            
            if(ftype != 'image/png' || ftype != 'image/jpeg' || ftype != 'image/jpg' || fsize > 5242880) {
                alert("The file must be image/png or image/jpeg and size of file must be under 5 mb!");
            }
        } else {
            alert("Please upgrade your browser, because your current browser lacks some new features we need!");
        }
    });

    $('#upload').on('click', function(){
        var title = $('#inputTitle').val();

        $('#uploading').show();

        $('#inputFile').upload(upload_link,
        {
            title: title
        },
        function(data){
            if(data.error) {
                $('#uploading').hide();
                if(data.messages.Title != "") {
                    $('#form_title').addClass('has-error');
                    $('#help-block-title').html(data.messages.Title);
                } else {
                    $('#form_title').addClass('has-success');
                }

                if(data.messages.Photo != "") {
                    $('#form_photo').addClass('has-error');
                    $('#help-block-photo').html(data.messages.Photo);
                } else {
                    $('#form_photo').addClass('has-success');
                }
            } else {
                var html = '<a href="'+url+'/photo/'+data.id+'" class="thumbnail">';
                html += '<img src="'+url+'/img/thumbnail/'+data.thumbnail_name+'" width="90" height="30"></a>';
                $('.modal-body').html(html);
            }
        },
        function(prog, value){
            $('#prog').width(value+'%');
        });
    });

    $('#new_upload').on('click', function(){
        $('#uploading').hide();
        $('.modal-body').html(modal_body);
    });
});
