{{ Form::open(array('role' => 'form')) }}
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		{{ Form::text(
		'email', 
		null, 
		array(
		'class' => 'form-control input-sm', 
		'placeholder' => trans('form.email'),
		)
		) }}
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		{{ Form::password(
		'password', 
		array(
		'class' => 'form-control input-sm',
		'placeholder' => trans('form.password')
		)
		) }}
	</div>
</div>						
<div class="checkbox">
	<label>
		{{ Form::checkbox('remember_me', Null, false) }} 
		{{ trans('form.remember_me') }}
	</label>
</div>
{{ Form::submit(trans('general.login'), array('class' => 'btn btn-success btn-block')) }}
{{link_to('forgotten_password', trans('general.forget_password'))}}
{{ Form::close() }}