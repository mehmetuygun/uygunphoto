@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_photos') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.user') }}</th>
	  				<th>{{ trans('admin.photo') }}</th>
	  				<th>{{ trans('admin.title') }}</th>
	  				<th>{{ trans('admin.active') }}</th>
	  				<th>{{ trans('admin.updated_at') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  				<th>{{ trans('admin.action') }}</th>
	  			</thead>
	  			<tbody>
	  			@foreach ($photos as $photo)
	  				<tr>
	  					<td>
	  						<a href="{{ url('admin/user/'.$photo->user->id) }}" class="btn btn-success btn-sm">
								<i class="glyphicon glyphicon-user"></i>
	  							{{ $photo->user->first_name.' '.$photo->user->last_name }}
	  						</a>
	  					</td>
	  					<td>
							<a href="#" class="thumbnail" data-toggle="tooltip" data-placement="top" title="{{ $photo->title }}">
								<img src="{{ url('/img/thumbnail/'.$photo->thumbnail_name) }}">
							</a>
						</td>
						<td>{{ $photo->title }}</td>
	  					<td>
	  						<div class="btn-group" data-toggle="buttons" data-commentid="{{ $photo->id }}">
	  							<label class="btn btn-default btn-sm btn-radio @if ($photo->active == 1) active @endif">
	  								<input type="radio" name="options" value="1" class="option"> {{ trans('admin.yes') }}
	  							</label>
	  							<label class="btn btn-default btn-sm btn-radio @if ($photo->active == 0) active @endif">
	  								<input type="radio" name="options" value="0" class="option"> {{ trans('admin.no') }}
	  							</label>
	  						</div>
	  					</td>
	  					<td>{{ $photo->updated_at }}</td>
	  					<td>{{ $photo->created_at }}</td>
	  					<td>
	  						<a href="{{ url('admin/photo/edit/'.$photo->id) }}" class="btn btn-primary btn-sm">{{ trans('admin.edit') }}</a>
	  						<button class="btn btn-danger btn-sm btn-delete" data-commentid="{{ $photo->id }}" data-toggle="modal" data-target="#AlertModal">Delete</button>
	  					</td>
	  				</tr>
	  			@endforeach
	  				<tr></tr>
	  			</tbody>
	  		</table>
			{{ $photos->links() }}
		</div>
	</div>
</div>
@include('admin/footer')