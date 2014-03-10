@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.system') }} / {{ trans('admin.configuration') }}</h3>
	</div>
	<div class="panel-body">
		<form action="" method="POST" class="form-horizontal" role="form">
			<div class="form-group @if (isset($messages) && $messages->has('meta_title')) has-error @endif">
				<label class="control-label col-sm-2" for="meta_title">{{ trans('admin.meta_title') }}</label>
				<div class="col-sm-10">
					{{ Form::text('meta_title', Input::old('meta_title') ? Input::old('meta_title') : $configuration->meta_title, array('class'=>'form-control', 'id'=> 'meta_title')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('meta_title'))
						{{$messages->first('meta_title')}}
		 			@endif
		 			</span>
				</div>
			</div>									
			<div class="form-group @if (isset($messages) && $messages->has('meta_description')) has-error @endif">
				<label class="control-label col-sm-2" for="meta_description">{{ trans('admin.meta_description') }}</label>
				<div class="col-sm-10">
					{{ Form::text('meta_description', Input::old('meta_description') ? Input::old('meta_description') : $configuration->meta_description, array('class'=>'form-control', 'id'=> 'meta_description')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('meta_description'))
						{{$messages->first('meta_description')}}
		 			@endif
		 			</span>
				</div>
			</div>									
			<div class="form-group">
				<label class="control-label col-sm-2" for="updated_at">{{ trans('admin.updated_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $configuration->updated_at }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="created_at">{{ trans('admin.created_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $configuration->created_at }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-success">{{ trans('admin.save_changes') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>
@include('admin/footer')