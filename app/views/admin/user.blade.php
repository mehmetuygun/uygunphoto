@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Manage User</h3>
	</div>
	<div class="panel-body admin-bottom">
		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.user') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  				<th>{{ trans('admin.action') }}</th>
	  			</thead>
	  			<tbody>
	  			@foreach ($users as $user)
	  				<tr>
	  					<td>
	  						<a href="{{ url('admin/user/'.$user->id) }}" class="btn btn-success">
								<i class="glyphicon glyphicon-user"></i>
	  							{{ $user->first_name.' '.$user->last_name }}
	  						</a>
	  					</td>
	  					<td>{{ $user->created_at }}</td>
	  					<td>
	  						<a href="#" class="btn btn-primary">{{ trans('admin.edit') }}</a>
	  						<button class="btn btn-danger" data-toggle="modal" data-target="#AlertModal">Delete</button>
	  					</td>
	  				</tr>
	  			@endforeach
	  				<tr></tr>
	  			</tbody>
	  		</table>
			{{ $users->links() }}
		</div>
	</div>
</div>
@include('admin/footer')