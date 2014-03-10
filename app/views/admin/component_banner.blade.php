@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_users') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.title') }}</th>
	  				<th>{{ trans('admin.sort') }}</th>
	  				<th>{{ trans('admin.types') }}</th>
	  				<th>{{ trans('admin.number_of_photos') }}</th>
	  				<th>{{ trans('admin.updated_at') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  			</thead>
	  			<tbody>
	  			
	  			</tbody>
	  		</table>
		</div>
	</div>
</div>
@include('admin/footer')