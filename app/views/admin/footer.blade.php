			</div>
		</div>
		<div id="footer">
			<div class="container" style="padding-top: 20px;">
				<p>{{ trans('general.developed_by') }} <a href="{{ trans('general.developer_url') }}">{{ trans('general.developer') }}</a></p>
			</div>
		</div>
		<div class="modal fade" id="AlertModal" tabindex="-1" role="dialog" aria-labelledby="AlertModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="AlertModalLabel">{{ trans('admin.warning') }}</h4>
					</div>
					<div class="modal-body">
						<p>{{ trans('admin.warning_delete') }}</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							<i class="glyphicon glyphicon-remove"></i> {{ trans('admin.cancel') }}
						</button>
						<button type="button" class="btn btn-primary" id="btn-delete">
							<i class="glyphicon glyphicon-thumbs-up"></i> {{ trans('admin.delete') }}
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		@if (isset($js))
			@foreach ($js as $key)
				{{HTML::script($key)}}
			@endforeach
		@endif
		<input type="hidden" name="url" value="{{ url('') }}" id="url">
		<script type="text/javascript">
			$(function() {
				$('[data-toggle=tooltip]').tooltip({trigger:'hover'});
				$('.btn-group').button();
			});
			
			function showAlert(alert_class, message, alert_body)
			{
				$('.alert').addClass(alert_class);
				$('.alert .alert-title').html(message);
				$('.alert .alert-body').html(alert_body);
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				$('.alert').show();
				setTimeout( "$('.alert').fadeOut('slow');",3000 );
			}
		</script>
	</body>
</html>