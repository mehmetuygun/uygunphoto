<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ trans('project.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('css/login.css')}}
</head>
<body>
	<div class="panel panel-info" id="login">
		<div class="panel-heading">
			<h3 class="panel-title">{{ trans('admin.login') }}</h3>
		</div>
		<div class="panel-body">
			@if (isset($error))
				<div class="alert alert-danger">
				{{ $error }}					
				</div>
			@endif
		 	<form action="" method="POST" role="form">
		 		<div class="form-group @if (isset($messages) && $messages->has('email')) has-error @endif">
		 			<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			 			<input type="text" class="form-control" name="email" placeholder="{{ trans('form.email') }}">
		 			</div>
		 			<span class="help-block">
		 			@if (isset($messages) && $messages->has('email'))
						{{$messages->first('email')}}
		 			@endif
		 			</span>
		 		</div>
		 		<div class="form-group @if (isset($messages) && $messages->has('password')) has-error @endif">
		 			<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			 			<input type="password" class="form-control" name="password" placeholder="{{ trans('form.password') }}">
		 			</div>
		 			<span class="help-block">
		 			@if (isset($messages) && $messages->has('password'))
						{{$messages->first('password')}}
		 			@endif
		 			</span>
		 		</div>
	 			<div class="form-group">
 					<button type="submit" class="btn btn-success">{{ trans('general.login') }}</button>
	 			</div>
 					<a href="{{url('/admin/forgot_password')}}">{{ trans('general.forget_password') }}</a>
		 	</form>
		</div>
	</div>
</body>
</html>