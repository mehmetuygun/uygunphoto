			</div>
		</div>
		<div id="footer">
			<div class="container" style="padding-top: 20px;">
				<p>{{ trans('general.developed_by') }} <a href="{{ trans('general.developer_url') }}">{{ trans('general.developer') }}</a></p>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">{{ trans('general.upload') }}</h4>
					</div>
					<div class="modal-body" >
						<div id="modal-body">
							<form class="form-horizontal" role="form">
								<div class="form-group">
									<label for="inputTitle" class="col-sm-3 control-label">{{ trans('form.title') }}</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="inputTitle" id="inputTitle" value="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputFile" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<input type="file" id="inputFile" name="inputFile">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">

									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<span id="upload_message"></span>
									</div>
								</div>
							</form>
						</div>
						<div id="uploading">
							<div class="progress progress-striped active" style="margin-bottom: 0">
								<div class="progress-bar" id="prog" role="progressbar" aria-valuenow="00" aria-valuemin="0" aria-valuemax="90"></div>
							</div>
							<p>{{ trans('message.uploading') }}</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('form.close') }}</button>
						<button type="button" id="new_upload" class="btn btn-success" data-dismis="modal">{{ trans('form.new') }}</button>
						<button type="submit" id="upload" class="btn btn-primary">{{ trans('general.upload') }}</button>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="url" id="url" value="{{url('')}}"> 
		<input type="hidden" name="public_path" id="public_path" value="{{public_path('')}}"> 
		@if (isset($js))
		@foreach ($js as $key)
		{{HTML::script($key)}}
		@endforeach
		@endif
	</body>
	</html>