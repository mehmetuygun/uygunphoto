@include('header')
<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">{{ trans('general.latest') }}</h3></div>
	<div class="panel-body">
		<div class="row">
			@foreach ($images as $image)
				<div class="col-xs-6 col-md-3">
					<a href="{{ url('/photo/'.$image->id) }}" class="thumbnail container">
						<img src="{{ url('/img/thumbnail/'.$image->thumbnail_name) }}" width="160" height="160">
					</a>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@include('footer')
