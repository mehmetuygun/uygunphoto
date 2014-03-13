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
                $('.modal-body').html('<a class="thumbnail" style="width: 160px; height: 110px;" href="'+url+'/photo/'+data.id+'"><img src="'+url+'/img/thumbnail/'+data.thumbnail_name+'" width="150" hegiht="100" /></a>');
            },
            function(prog, value){
                $('#prog').width(value+'%');
            });
    });
    $('#new_upload').on('click', function(){
        $('.modal-body').html(modal_body);
    });
});
