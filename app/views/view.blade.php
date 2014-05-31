@include('header')
@foreach ($panels as $panel)
	<div class="panel panel-default banner">
		<div class="panel-heading"><h3 class="panel-title banner-title">{{ $panel->title }}</h3></div>
		<div class="panel-body banner-body">
			<div class="row">
				@foreach ($panel->images as $p)
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default panel-image">
							<div class="panel-thumbnail">
								<a href="{{url('photo/'.$p->image->id)}}">
									<img src="{{ url('img/thumbnail/'.$p->image->thumbnail_name) }}" class="img-responsive">
								</a>
							</div>
							<div class="panel-body panel-thumbnail-body">
								<div class="panel-image-title lead">{{ $p->image->title }}</div>
								<div><a href="{{url('profile/'.$p->image->user->id)}}"><i class="glyphicon glyphicon-user"></i> {{$p->image->user->first_name.' '.$p->image->user->last_name}}</a></div>
								<h5><span class="label label-warning"><i class="glyphicon glyphicon-comment"></i> {{Image::find($p->image->id)->comment()->count()}}</span> </h5>
									<a class="btn btn-social-icon btn-twitter btn-xs" target="_blank" title="On Facebook" href="http://www.facebook.com/sharer.php?u={{url('/photo/'.$p->image->id)}}">
										<i class="fa fa-facebook"></i>
									</a>
									<a class="btn btn-social-icon btn-twitter btn-xs" target="_blank" title="On Twitter" href="http://twitter.com/share?url={{url('/photo/'.$p->image->id)}}">
										<i class="fa fa-twitter fa-lg tw"></i>
									</a>
									<a class="btn btn-social-icon btn-google-plus btn-xs" target="_blank" title="On Google Plus" href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url={{url('/photo/'.$p->image->id)}}">
										<i class="fa fa-google-plus fa-lg google"></i>
									</a>
									<a class="btn btn-social-icon btn-linkedin btn-xs" target="_blank" title="On LinkedIn" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url('/photo/'.$p->image->id)}}">
										<i class="fa fa-linkedin fa-lg linkin"></i>
									</a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	@endforeach
	</div>
@include('footer')
