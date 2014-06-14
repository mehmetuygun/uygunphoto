@include('header')
@foreach ($panels as $panel)
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{{ $panel->title }}</h3>
	</div>
	<ul class="bxslider">
		@foreach ($panel->images as $p)
				<li>
					<a href="{{ url('photo/'.$p->image->id) }}">
						<img src="{{ url('img/thumbnail/'.$p->image->thumbnail_name) }}"/>
					</a>
					<div class="panel-image-content">
						<div class="panel-image-title lead">{{ $p->image->title }}</div>
						<div class="panel-image-owner">
							<a href="{{url('profile/'.$p->image->user->id)}}"><i class="glyphicon glyphicon-user"></i> 
							{{ $p->image->user->first_name.' '.$p->image->user->last_name }}
							</a>
						</div>
					</div>
				</li>
		@endforeach
	</ul>
</div>
	@endforeach
	</div>
@include('footer')
