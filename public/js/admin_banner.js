$(function(){

	var url = $('#url').val();
	var banner_id;
	var banner_row;

	$('.btn-radio').on('click', function() {
		var active = $(this).find('input[type=radio]').val();
		var banner_id = $(this).parent().data('commentid');
		RunBannerAjaxActive(banner_id, active);
	});

	$('.btn-delete').on('click', function() {
		banner_id = $(this).data('commentid');
		banner_row = $(this).closest('tr');
	});

	$('#btn-delete').on('click', function() {
		$('#AlertModal').modal('hide')
		RunBannerAjaxDelete(banner_id, banner_row);
	})

	function RunBannerAjaxActive(banner_id, active)
	{
		$.post(url+'/admin/component/banner/ajax/active', {banner_id: banner_id, active: active}, function(json) {
			if(json.e == 1) {
				showAlert('alert-success', 'Message:', json.message);
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}

	function RunBannerAjaxDelete(banner_id, banner_row)
	{
		$.post(url+'/admin/component/banner/ajax/delete', {banner_id: banner_id}, function(json) {
			if(json.e == 1) {
				// showAlert('alert-success', 'Message:', json.message);
				banner_row.fadeOut( 1000 );
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}
});