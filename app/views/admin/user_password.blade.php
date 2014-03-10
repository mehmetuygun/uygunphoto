@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.change_password') }}</h3>
	</div>
	<div class="panel-body">
		<form action="" method="POST" class="form-horizontal" role="form">
			<div class="form-group @if (isset($messages) && $messages->has('current_password')) has-error @endif">
				<label class="control-label col-sm-2" for="user_password">{{ trans('admin.current_password') }}</label>
				<div class="col-sm-10">
				<Input type="password" name="current_password" value="{{Input::old('current_password')}}" class="form-control" id="user_current_password" >
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('current_password'))
						{{$messages->first('current_password')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group @if (isset($messages) && $messages->has('new_password')) has-error @endif">
				<label class="control-label col-sm-2" for="user_new_password">{{ trans('admin.new_password') }}</label>
				<div class="col-sm-10">
				<Input type="password" name="new_password" value="{{Input::old('new_password')}}" class="form-control" id="user_new_password" >
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('new_password'))
						{{$messages->first('new_password')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group @if (isset($messages) && $messages->has('confirm_password')) has-error @endif">
				<label class="control-label col-sm-2" for="user_confirm_password">{{ trans('admin.confirm_password') }}</label>
				<div class="col-sm-10">
					<Input type="password" name="confirm_password" value="{{Input::old('confirm_password')}}" class="form-control" id="user_confirm_password" >
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('confirm_password'))
						{{$messages->first('confirm_password')}}
		 			@endif
		 			</span>
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