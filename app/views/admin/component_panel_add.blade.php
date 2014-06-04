@include('admin/header')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">{{ trans('admin.add_panel') }}</h3>
	</div>
	<div class="panel-body admin-bottom">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group @if(isset($messages) && $messages->has('title')) has-error @elseif(isset($messages)) has-success @endif">
				<label for="inputTitle" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" value="{{ Input::old('title') }}">
					<span class="help-block">
						@if (isset($messages))
							{{ $messages->first('title') }}
						@endif
					</span>
				</div>
			</div>
			<div class="form-group @if(isset($messages) && $messages->has('position')) has-error @elseif(isset($messages)) has-success @endif">
				<label for="inputPosition" class="col-sm-2 control-label">Position</label>
				<div class="col-sm-10">
					{{ Form::select(
						'position',
						$positions,
						null,
						array(
							'class' => 'form-control',
							'id' => 'inputPosition',
							'placeholder' => 'Position',
						)
					)}}
					<span class="help-block">
					@if (isset($messages))
						{{ $messages->first('position') }}
					@endif
					</span>
				</div>
			</div>
			<div class="form-group @if(isset($messages) && $messages->has('type')) has-error @elseif(isset($messages)) has-success @endif">
				<label for="inputType" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
					{{ Form::select(
						'type', 
						$types,
						null,
						array(
							'class' => 'form-control', 
							'id' => 'inputType', 
							'placeholder' => 
							'Type'
						)) }}

					<span class="help-block">
					@if (isset($messages))
						{{ $messages->first('type') }}
					@endif
					</span>
				</div>
			</div>
			<div id="selectPhoto">
				<div class="form-group @if(isset($messages) && $messages->has('image')) has-error @elseif(isset($messages)) has-success @endif">
					<label for="inputImage" class="col-sm-2 control-label">Select Photos</label>
					<div class="col-sm-10">
						<input type="hidden" name="image" style="width:100%" id="inputImage" value="{{ Input::old('image') }}">
						<span class="help-block">
						@if (isset($messages))
							{{ $messages->first('image') }}
						@endif
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</div>
		</form>
	</div>
</div>
@include('admin/footer')