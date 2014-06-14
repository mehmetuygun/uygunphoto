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
			@include('form.login')
		</div>
	</div>
</body>
</html>