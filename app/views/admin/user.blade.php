@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_users') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.user') }}</th>
	  				<th>{{ trans('admin.email') }}</th>
	  				<th>{{ trans('admin.comments') }}</th>
	  				<th>{{ trans('admin.photos') }}</th>
	  				<th>{{ trans('admin.updated_at') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  				<th>{{ trans('admin.action') }}</th>
	  			</thead>
	  			<tbody>
	  			@foreach ($users as $user)
	  				<tr>
	  					<td>
	  						<button class="btn btn-success btn-sm" disabled="disabled">
								<i class="glyphicon glyphicon-user"></i>
	  							{{ $user->first_name.' '.$user->last_name }}
	  						</button>
	  					</td>
	  					<td>{{ $user->email }}</td>
	  					<td>{{ $user->comments()->count() }}</td>
	  					<td>{{ $user->images()->count() }}</td>
	  					<td>{{ $user->updated_at }}</td>
	  					<td>{{ $user->created_at }}</td>
	  					<td>
	  						<a href="{{ url('admin/user/edit/'.$user->id) }}" class="btn btn-primary btn-sm">{{ trans('admin.edit') }}</a>
	  						<button class="btn btn-danger btn-sm btn-delete" data-userid="{{ $user->id }}" data-toggle="modal" data-target="#AlertModal">{{ trans('admin.delete') }}</button>
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