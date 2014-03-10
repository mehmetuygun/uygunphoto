@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_users') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<a href="{{url('admin/component/banner/add')}}" style="margin-bottom: 15px" class="btn btn-sm btn-primary pull-right">{{ trans('admin.add') }}</a>

		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.title') }}</th>
	  				<th>{{ trans('admin.sort') }}</th>
	  				<th>{{ trans('admin.types') }}</th>
	  				<th>{{ trans('admin.number_of_photos') }}</th>
	  				<th>{{ trans('admin.active') }}</th>
	  				<th>{{ trans('admin.updated_at') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  			</thead>
	  			<tbody>
				@if ($banners->count() < 1)
					<tr><td colspan="6" style="text-align:center">{{ trans('admin.no_record_found') }}</td></tr>
				@elseif ($banners->count() > 0)
					@foreach ($banners as $banner)
						<tr>
							<td>{{ $banner->title }}</td>
							<td>{{ $banner->sort }}</td>
							<td>{{ $banner->type }}</td>
							<td>{{ $banner->images->count() }}</td>
							<td>
		  						<div class="btn-group" data-toggle="buttons" data-commentid="{{ $banner->id }}">
		  							<label class="btn btn-default btn-sm btn-radio @if ($banner->active == 1) active @endif">
		  								<input type="radio" name="options" value="1" class="option"> {{ trans('admin.yes') }}
		  							</label>
		  							<label class="btn btn-default btn-sm btn-radio @if ($banner->active == 0) active @endif">
		  								<input type="radio" name="options" value="0" class="option"> {{ trans('admin.no') }}
		  							</label>
		  						</div>
							</td>
							<td>{{ $banner->updated_at }}</td>
							<td>{{ $banner->created_at }}</td>
						</tr>
					@endforeach
				@endif
	  			</tbody>
	  		</table>
	  		{{ $banners->links() }}
		</div>
	</div>
</div>
@include('admin/footer')