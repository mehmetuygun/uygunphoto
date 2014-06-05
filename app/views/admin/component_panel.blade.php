@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_panels') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<a href="{{url('admin/component/panel/add')}}" style="margin-bottom: 15px" class="btn btn-sm btn-primary">{{ trans('admin.add_new_panel') }}</a>

		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.title') }}</th>
	  				<th>{{ trans('admin.position') }}</th>
	  				<th>{{ trans('admin.number_of_photos') }}</th>
	  				<th>{{ trans('admin.active') }}</th>
	  				<th>{{ trans('admin.updated_at') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  				<th>{{ trans('admin.action') }}</th>
	  			</thead>
	  			<tbody>
				@if ($panels->count() < 1)
					<tr><td colspan="6" style="text-align:center">{{ trans('admin.no_record_found') }}</td></tr>
				@elseif ($panels->count() > 0)
					@foreach ($panels as $panel)
						<tr>
							<td>{{ $panel->title }}</td>
							<td>{{ $panel->position }}</td>
							<td>{{ $panel->images->count() }}</td>
							<td>
		  						<div class="btn-group" data-toggle="buttons" data-commentid="{{ $panel->id }}">
		  							<label class="btn btn-default btn-sm btn-radio @if ($panel->active == 1) active @endif">
		  								<input type="radio" name="options" value="1" class="option"> {{ trans('admin.yes') }}
		  							</label>
		  							<label class="btn btn-default btn-sm btn-radio @if ($panel->active == 0) active @endif">
		  								<input type="radio" name="options" value="0" class="option"> {{ trans('admin.no') }}
		  							</label>
		  						</div>
							</td>
							<td>{{ $panel->updated_at }}</td>
							<td>{{ $panel->created_at }}</td>
							<td>
		  						<a href="{{ url('admin/component/panel/edit/'.$panel->id) }}" class="btn btn-primary btn-sm">{{ trans('admin.edit') }}</a>
		  						<button class="btn btn-danger btn-sm btn-delete" data-panelid="{{ $panel->id }}" data-toggle="modal" data-target="#AlertModal">Delete</button>
	  						</td>
						</tr>
					@endforeach
				@endif
	  			</tbody>
	  		</table>
	  		{{ $panels->links() }}
		</div>
	</div>
</div>
@include('admin/footer')