@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.manage_comment') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<div class="table-responsive">
		  	<table class="table table-bordered">
	  			<thead>
	  				<th>{{ trans('admin.user') }}</th>
	  				<th>{{ trans('admin.photo') }}</th>
	  				<th>{{ trans('admin.comment_description') }}</th>
	  				<th>{{ trans('admin.active') }}</th>
	  				<th>{{ trans('admin.created_at') }}</th>
	  				<th>{{ trans('admin.action') }}</th>
	  			</thead>
	  			<tbody>
	  			@foreach ($comments as $comment)
	  				<tr>
	  					<td>
	  						<a href="{{ url('admin/user/'.$comment->user->id) }}" class="btn btn-success btn-sm">
								<i class="glyphicon glyphicon-user"></i>
	  							{{ $comment->user->first_name.' '.$comment->user->last_name }}
	  						</a>
	  					</td>
	  					<td>
							<a href="#" class="thumbnail" data-toggle="tooltip" data-placement="top" title="{{ $comment->image->title }}">
								<img src="{{ url('/img/thumbnail/'.$comment->image->thumbnail_name) }}">
							</a>
						</td>
	  					<td>
	  						<div class="comment_box">
	  							{{ $comment->description }}
	  						</div>
	  					</td>
	  					<td>
	  						<div class="btn-group" data-toggle="buttons" data-commentid="{{ $comment->id }}">
	  							<label class="btn btn-default btn-sm btn-radio @if ($comment->active == 1) active @endif">
	  								<input type="radio" name="options" value="1" class="option"> {{ trans('admin.yes') }}
	  							</label>
	  							<label class="btn btn-default btn-sm btn-radio @if ($comment->active == 0) active @endif">
	  								<input type="radio" name="options" value="0" class="option"> {{ trans('admin.no') }}
	  							</label>
	  						</div>
	  					</td>
	  					<td>{{ $comment->created_at }}</td>
	  					<td>
	  						<a href="{{ url('admin/comment/edit/'.$comment->id) }}" class="btn btn-primary btn-sm">{{ trans('admin.edit') }}</a>
	  						<button class="btn btn-danger btn-sm btn-delete" data-commentid="{{ $comment->id }}" data-toggle="modal" data-target="#AlertModal">Delete</button>
	  					</td>
	  				</tr>
	  			@endforeach
	  				<tr></tr>
	  			</tbody>
	  		</table>
			{{ $comments->appends(array('sort' => 'crea'))->links() }}
		</div>
	</div>
</div>
@include('admin/footer')