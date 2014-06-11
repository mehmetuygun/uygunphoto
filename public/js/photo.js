$(document).ready(function() {
    // resize_photo();
    // comment();

    $('#comment_save').on('click', function() {
        comment_ajax();
        // alert("test");
    });
});

// $(window).resize(resize_photo);

// $(window).resize(comment);

// function comment() {
//     var comment_box = $('.comment_box').height();
//     var comment_header = $('.comment_header').height();
//     var dif = comment_box - comment_header;
//     $('#comment_frame_id').css("height", dif);
//     alert("testtt");
// }

// function resize_photo() {
//     var jwindow = $(window);
//     var photo_content = $('#content #photo');
//     var web_image = $('.web_image');

//     if (jwindow.width() > 768) {
//         var window_height = jwindow.height() - 160;
//         photo_content.height(window_height);
//         web_image.css('margin-top', (window_height - web_image.height()) / 2);
//     } else {
//         photo_content.height('auto');
//         web_image.css('margin-top', 0);
//     }
// }

function comment_ajax() {
    var url = $('#url').val();
    $.post(url+"/ajax/comment", $('#comment_form').serialize(), function(data) {
        if(data.error) {
            alert(data.error);
        } else {
            do_action(data);
        }
    });
}

function do_action(data) {
    var url = $('#url').val();
    var html = "";
    html += '<div class="media">';
    html +=  '<a class="pull-left" href="#">';
    html +=  '    <img class="media-object" src="'+url+'/img/avatar/user-64.png" width="32" height="32" alt="Image">';
    html +=   '</a>';
    html +=  '<div class="media-body">';
    html +=      '<h5 class="media-heading">';
    html +=      '<a href="#">'+data.full_name+'</a>';
    html += '</h5>';
    html += '<p>'+data.comment_description+'</p>';
    html +='</div>';
    html += '</div>';
    $('.comment_frame').prepend(html);
    $('#comment_form #comment_description').val('');
}