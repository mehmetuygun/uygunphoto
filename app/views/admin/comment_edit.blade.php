@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.edit_comment') }}</h3>
	</div>
	<div class="panel-body">
		<form action="" method="POST" class="form-horizontal" role="form">
			<div class="form-group">
				<label class="control-label col-sm-2" for="comment_id">{{ trans('admin.comment_id') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $comment->id }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="comment_description">{{ trans('admin.comment_description') }}</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="comment_description" id="comment_description">
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="updated_at">{{ trans('admin.updated_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $comment->updated_at }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="created_at">{{ trans('admin.created_at') }}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $comment->created_at }}</p>
					<!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-success">{{ trans('admin.save_changes') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>
@include('admin/footer')