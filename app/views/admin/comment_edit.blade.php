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
			<div class="form-group @if (isset($messages) && $messages->has('description')) has-error @endif">
				<label class="control-label col-sm-2" for="comment_description">{{ trans('admin.comment_description') }}</label>
				<div class="col-sm-10">
					{{ Form::textarea('description', Input::old('description') ? Input::old('description') : $comment->description, array('class'=>'form-control', 'id'=> 'comment_description', 'rows'=>'3')) }}
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('description'))
						{{$messages->first('description')}}
		 			@endif
		 			</span>
				</div>
			</div>			
			<div class="form-group @if (isset($messages) && $messages->has('active')) has-error @endif">
				<label class="control-label col-sm-2" for="comment_active">{{ trans('admin.comment_active') }}</label>
				<div class="col-sm-10">
					<div class="btn-group" data-toggle="buttons" data-commentid="{{ $comment->id }}">
						<label class="btn btn-default btn-sm btn-radio @if(Input::old('active')==1) active @elseif(Input::old('active') != 1 && Input::old('active') != 0 && $comment->active == 1) active @endif">
							<input type="radio" name="active" value="1" class="option" @if(Input::old('active')==1) checked="checked" @elseif(Input::old('active') != 1 && Input::old('active') != 0 && $comment->active == 1) checked="checked" @endif> {{ trans('admin.yes') }}
						</label>
						<label class="btn btn-default btn-sm btn-radio @if(Input::old('active')==0) active @elseif(Input::old('active') != 0 && Input::old('active') != 1 && $comment->active == 0) active @endif">
							<input type="radio" name="active" value="0" class="option" @if(Input::old('active')==0) checked="checked" @elseif(Input::old('active') != 0 && Input::old('active') != 1 && $comment->active == 0) checked="checked" @endif > {{ trans('admin.no') }}
						</label>
					</div>
					<span class="help-block">
		 			@if (isset($messages) && $messages->has('active'))
						{{$messages->first('active')}}
		 			@endif
		 			</span>
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