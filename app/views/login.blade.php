@include('header')
<div class="container">
	<div class="row centered-form">
		<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ trans('general.login') }} 
					</h3>
				</div>
				<div class="panel-body">
					@if (isset($error))
					<div class="alert alert-danger">
						{{ trans('error.login') }}
					</div>
					@endif
					<form role="form" method="POST" action="">
						<div class="form-group">
							<input type="email" name="email" class="form-control input-sm" placeholder="{{ trans('form.email') }}" value="{{ Input::old('email')}}">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control input-sm" placeholder="{{ trans('form.password') }}" value="{{ Input::old('password')}}">
						</div>
						<p>{{link_to('forgotten_password', trans('general.forget_password'))}}</p>
						<input type="submit" value="{{ trans('general.login') }}" class="btn btn-primary btn-block">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@include('footer')