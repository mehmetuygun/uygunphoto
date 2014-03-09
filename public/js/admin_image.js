$(function(){

	var url = $('#url').val();
	var image_id;
	var image_row;

	$('.btn-radio').on('click', function() {
		var active = $(this).find('input[type=radio]').val();
		var image_id = $(this).parent().data('commentid');
		RunPhotoAjaxActive(image_id, active);
	});

	$('.btn-delete').on('click', function() {
		image_id = $(this).data('commentid');
		image_row = $(this).closest('tr');
	});

	$('#btn-delete').on('click', function() {
		$('#AlertModal').modal('hide')
		RunPhotoAjaxDelete(image_id, image_row);
	})

	function RunPhotoAjaxActive(image_id, active)
	{
		$.post(url+'/admin/photo/ajax/active', {image_id: image_id, active: active}, function(json) {
			if(json.e == 1) {
				showAlert('alert-success', 'Message:', json.message);
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}

	function RunPhotoAjaxDelete(image_id, image_row)
	{
		$.post(url+'/admin/photo/ajax/delete', {image_id: image_id}, function(json) {
			if(json.e == 1) {
				// showAlert('alert-success', 'Message:', json.message);
				image_row.fadeOut( 1000 );
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}
});