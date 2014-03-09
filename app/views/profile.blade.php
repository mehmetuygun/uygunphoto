@include('header')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{{trans('general.profile')}}</h3>
	</div>
	<div class="panel-body">
		<div class="media">
			<a class="pull-left" href="#">
				<img class="media-object" src="{{url('img/avatar/user-64.png')}}" width="100" height="100">
			</a>
			<div class="media-body">
				<h3 class="media-heading">{{$user->first_name.' '.$user->last_name}}</h3>
			</div>
		</div>

		<div class="profile_content">
			@foreach ($images as $image)
			<div class="col-xs-6 col-md-3">
				<a href="{{ url('/photo/'.$image->id) }}" class="thumbnail container">
					<img src="{{ url('/img/thumbnail/'.$image->thumbnail_name) }}" width="160" height="160">
				</a>
			</div>
			@endforeach
		</div>
		<div class="clearfix"></div>
		{{$images->links()}}
	</div>
</div>
@include('footer')