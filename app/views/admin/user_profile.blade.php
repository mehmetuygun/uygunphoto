@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.edit_profile') }}</h3>
	</div>
	<div class="panel-body">
		<form action="" method="POST" class="form-horizontal" role="form">
			<div class="form-group @if (isset($messages) && $messages->has('first_name')) has-error @endif">
				<label class="control-label col-sm-2" for="user_first_name">{{ trans('admin.first_name') }}</label>
				<div class="col-sm-10">
					{{ Form::text('first_name', Input::old('first_name') ? Input::old('first_name') : $user->first_name, array('class'=>'form-control', 'id'=> 'user_first_name')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('first_name'))
						{{$messages->first('first_name')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group @if (isset($messages) && $messages->has('last_name')) has-error @endif">
				<label class="control-label col-sm-2" for="user_last_name">{{ trans('admin.last_name') }}</label>
				<div class="col-sm-10">
					{{ Form::text('last_name', Input::old('last_name') ? Input::old('last_name') : $user->last_name, array('class'=>'form-control', 'id'=> 'user_last_name')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('last_name'))
						{{$messages->first('last_name')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group @if (isset($messages) && $messages->has('email')) has-error @endif">
				<label class="control-label col-sm-2" for="user_email">{{ trans('admin.email') }}</label>
				<div class="col-sm-10">
					{{ Form::text('email', Input::old('email') ? Input::old('email') : $user->email, array('class'=>'form-control', 'id'=> 'user_email')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('email'))
						{{$messages->first('email')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-sm-2" for="updated_at">{{ trans('admin.updated_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $user->updated_at }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="created_at">{{ trans('admin.created_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $user->created_at }}</p>
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