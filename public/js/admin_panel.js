$(function(){

	var url = $('#url').val();
	var panel_id;
	var panel_row;

	$('.btn-radio').on('click', function() {
		var active = $(this).find('input[type=radio]').val();
		var panel_id = $(this).parent().data('commentid');
		RunpanelAjaxActive(panel_id, active);
	});

	$('.btn-delete').on('click', function() {
		panel_id = $(this).data('commentid');
		panel_row = $(this).closest('tr');
	});

	$('#btn-delete').on('click', function() {
		$('#AlertModal').modal('hide')
		RunpanelAjaxDelete(panel_id, panel_row);
	})

	function RunpanelAjaxActive(panel_id, active)
	{
		$.post(url+'/admin/component/panel/ajax/active', {panel_id: panel_id, active: active}, function(json) {
			if(json.e == 1) {
				showAlert('alert-success', 'Message:', json.message);
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}

	function RunpanelAjaxDelete(panel_id, panel_row)
	{
		$.post(url+'/admin/component/panel/ajax/delete', {panel_id: panel_id}, function(json) {
			if(json.e == 1) {
				// showAlert('alert-success', 'Message:', json.message);
				panel_row.fadeOut( 1000 );
			} else {
				showAlert('alert-danger', 'Error:', json.message);
			}
		});
	}
});