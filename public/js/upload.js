$(document).ready(function(){

    var error_type = $("#error_type").val();
    var valid = true;
    var upload_link = $("#upload_link").val();
    var error_title_length;
    var modal_body = $('#modal-body').clone();
    var public_path = $('#public_path').val();
    var new_upload = $('#new_upload').val();
    var path = $('#path').val();

    $('#uploading').hide();

    $("#inputFile").change(function() {
        var val = $(this).val();
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpg': case 'png':
            valid = true;
            break;
            default:
            alert(error_type);
            valid = false;
            break;
        }
    });

    $('#upload').on('click', function(){
        if(valid == true)
            var title = $('#inputTitle').val();

            $('#modal-body').hide();
            $('#uploading').show();

            $('#inputFile').upload(upload_link,
            {
                title: title
            },
            function(data){
                $('#prog').addClass("progress-bar-success");
                $('.modal-body').html('<a class="thumbnail" style="width: 170px;height: 170px;" href="'+path+'/photo/'+data.id+'"><img src="'+path+'/img/thumbnail/'+data.thumbnail_name+'" width="160" hegiht="160" /></a>');
            },
            function(prog, value){
                $('#prog').width(value+'%');
            });
    });
    $('#new_upload').on('click', function(){
        $('.modal-body').html(modal_body);
    });
});
