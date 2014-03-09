$(function(){

	var url = $('#url').val();
	var comment_id;
	var comment_row;

	$('.btn-radio').on('click', function() {
		var active = $(this).find('input[type=radio]').val();
		var comment_id = $(this).parent().data('commentid');
		RunCommentAjaxActive(comment_id, active);
	});

	$('.btn-delete').on('click', function() {
		comment_id = $(this).data('commentid');
		comment_row = $(this).closest('tr');
	});

	$('#btn-delete').on('click', function() {
		$('#AlertModal').modal('hide')
		RunCommentAjaxDelete(comment_id, comment_row);
	})

	function RunCommentAjaxActive(comment_id, active)
	{
		$.post(url+'/admin/comment/ajax/active', {comment_id: comment_id, active: active}, function(json) {
			if(json.e == 1) {
				showAlert('alert-success', 'Message:', json.message);
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}

	function RunCommentAjaxDelete(comment_id, comment_row)
	{
		$.post(url+'/admin/comment/ajax/delete', {comment_id: comment_id}, function(json) {
			if(json.e == 1) {
				// showAlert('alert-success', 'Message:', json.message);
				comment_row.fadeOut( 1000 );
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}
});