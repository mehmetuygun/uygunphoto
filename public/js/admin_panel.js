$(function(){

	var url = $('#url').val();
	var panel_id;
	var panel_row;

	$('.btn-radio').on('click', function() {
		var active = $(this).find('input[type=radio]').val();
		var panel_id = $(this).parent().data('panelid');
		RunpanelAjaxActive(panel_id, active);
	});

	$('.btn-delete').on('click', function() {
		panel_id = $(this).data('panelid');
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

	$.post(url+'/admin/photo/ajax/getphotos', {term: 'o'}, function(json) {
		$var = 'var';
	});

	$('#inputType').on('change', function() 
	{
		if(this.value == 1) {
			$('#selectPhoto').show();
		} else {
			$('#selectPhoto').hide();
		}
	});

	// $('#inputImage').select2({
	// 	multiple: true,
	// 	createSearchChoice:function(term, data) { 
	// 			if ($(data).filter(function() { 
	// 				return this.text.localeCompare(term)===0; 
	// 			}).length===0) {
	// 			return {id:term, text:term};
	// 		} 
	// 	},
 //    }); // end of select2

	MultiAjaxAutoComplete('#inputImage', url+'/admin/photo/ajax/getphotos')

	function MultiAjaxAutoComplete(element, url) {
		$(element).select2({
			placeholder: "Search for a photo",
			multiple: true,
			ajax: {
				url: url,
				dataType: 'json',
				data: function(term, page) {

					return {
						q: term,
                    };
                },
                results: function(data, page) {
                	return {
                		results: data.photos
                	};
                }
            },
            formatResult: formatResult,
            formatSelection: formatSelection,
            initSelection : function (element, callback) {
				var data = [];
				var	idList = element.val();
				if (idList) {
					$.get(url, {id: idList}, function (res) {
						for (var i in res.photos) {
							var photo = res.photos[i];
							data.push({id: photo.id, title: photo.title});
						}
		                callback(data);
					});
				}
            }
            // initSelection: function(element, callback) {
            // 	var data = [];
            // 	$(element.val().split(",")).each(function(i) {
            // 		var item = this.split(':');
            // 		data.push({
            // 			id: item[0],
            // 			title: item[1]
            // 		});
            // 	});
            //     //$(element).val('');
            //     callback(data);
            // }
        });
	};

	function formatResult(photo) {
		return '<div><img src="'+ url + '/img/thumbnail/' + photo.thumbnail_name + '" width="128" height="84"> '  + photo.title + '</div>';
	};

	function formatSelection(data) {
		return data.title;
	};

	$('.select2-choices').sortable({
		containment: 'parent',
		start: function() { $('#inputImage').select2("onSortStart"); },
		update: function() { $('#inputImage').select2("onSortEnd"); }
	});
});