@include('header')
<div class="container">
	<div class="row centered-form">
		<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-log-in"></span> {{ trans('general.login') }} 
					</h3>
				</div>
				<div class="panel-body" style="padding-bottom: 15px">
					@if (isset($error))
					<div class="alert alert-danger">
						{{ trans('error.login') }}
					</div>
					@endif
					@include('form.login')
				</div>
			</div>
		</div>
	</div>
</div>
@include('footer')