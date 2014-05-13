@include('header')
<div class="container">
	<div class="row centered-form">
		<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
			<div class="panel panel-default banner">
				<div class="panel-heading">
					<h3 class="panel-title banner-title">{{ trans('general.create_account') }} 
						<small>{{ trans('general.register_info') }}</small>
					</h3>
				</div>
				<div class="panel-body banner-body" style="padding-bottom: 15px">
					<form role="form" method="POST" action="">
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="first_name" class="form-control input-sm" placeholder="{{ trans('form.first_name') }}" value="">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="last_name" class="form-control input-sm" placeholder="{{ trans('form.last_name') }}" value="">
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control input-sm" placeholder="{{ trans('form.email') }}" value="">
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" class="form-control input-sm" placeholder="{{ trans('form.password') }}" value="">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="confirm_password" class="form-control input-sm" placeholder="{{ trans('form.confirm_password') }}" value="">
								</div>
							</div>
						</div>
						<p style="color: white">
						By clicking Create an account, you agree to our <a href="{{ url('terms_and_condtions')}}">Terms and Condtions.</a>
						</p>
						<input type="submit" value="{{ trans('general.create_account') }}" class="btn btn-primary btn-block">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@include('footer')