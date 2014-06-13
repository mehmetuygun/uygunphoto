$(document).ready(function() {
    // resize_photo();
    // comment();

    $('#comment_save').on('click', function() {
        comment_ajax();
        // alert("test");
    });    
    $('#load_more_comments').on('click', function() {
        load_more_comment();
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

function load_more_comment() {
    var url = $('#url').val();
    $.post(url+"/ajax/load_more_comment", $('#load_more_comments_form').serialize(), function(data) {
        if(data.error) {
            alert(data.error);
        } else {
            var length = data.length;
            var html = "";
            for(var i = 0;i<length;i++) {
                html += '<div class="media">';
                html +=  '<a class="pull-left" href="'+url+'/profile/'+data[i]['id']+'">';
                html +=  '    <img class="media-object" src="'+url+'/img/avatar/user-64.png" width="32" height="32" alt="Image">';
                html +=   '</a>';
                html +=  '<div class="media-body">';
                html +=      '<h5 class="media-heading">';
                html +=      '<a href="#">'+data[i]['first_name']+' '+data[i]['last_name']+'</a>';
                html += '<span class="sub-text">'+data[i]['created_at']+'</a>';
                html += '</h5>';
                html += '<span class="comment-text">'+data[i]['description']+'</span>';
                html +='</div>';
                html += '</div>';
            }
            var page_number = parseInt($('#page_number').val());
            page_number += 1;
            $('#page_number').val(page_number);
            $('.comment-box').append(html);
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
    html += '<span class="sub-text">'+data.created_at.date+'</a>';
    html += '</h5>';
    html += '<span class="comment-text">'+data.comment_description+'</span>';
    html +='</div>';
    html += '</div>';
    $('.comment-box').prepend(html);
    $('#comment_form #comment_description').val('');
}