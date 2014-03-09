$(function(){

	var url = $('#url').val();
	var user_id;
	var user_row;

	$('.btn-delete').on('click', function() {
		user_id = $(this).data('userid');
		user_row = $(this).closest('tr');
	});

	$('#btn-delete').on('click', function() {
		$('#AlertModal').modal('hide')
		RunCommentAjaxDelete(user_id, user_row);
	})

	function RunCommentAjaxDelete(user_id, user_row)
	{
		$.post(url+'/admin/user/ajax/delete', {user_id: user_id}, function(json) {
			if(json.e == 1) {
				// showAlert('alert-success', 'Message:', json.message);
				user_row.fadeOut( 1000 );
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}
});