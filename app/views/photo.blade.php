@include('header')
<div class="row" id="photo">
    <div class="col-xs-12 col-sm-8 col-md-8 banner-body" id="img_box">
        <img src="{{url('/img/web/'.$image->web_name)}}" class="web_image"/>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 banner-body" id="comment_box">
    <div class="comment_header">
    <h4 class="panel-image-title"><span class="glyphicon glyphicon-paperclip white"></span> {{$image->title}}</h4>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="{{url('img/avatar/user-64.png')}}" width="32" height="32" alt="Image">
            </a>
            <div class="media-body">
                <h5 class="media-heading">
                    <a href="{{url('profile/'.$user->id)}}">{{$user->first_name.' '.$user->last_name}}</a>
                </h5>
                <p class="date">{{$image->created_at}}</p>
            </div>
        </div>
        <form id="comment_form">
            <input type="hidden" name="image_id" value="{{$image->id}}">
            <p><textarea name="description" cols="2" class="form-control" id="comment_description" name="comment" placeholder="{{trans('message.leave_comment')}}"></textarea></p>
            <p><button type="button" id="comment_save" class="btn btn-primary btn-xs">Save</button></p>
        </form>
        
    </div>
        <div class="comment_frame" id="comment_frame_id">
            @foreach ($image->comment as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{url('img/avatar/user-64.png')}}" width="32" height="32" alt="Image">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">
                        <a href="#">{{ $comment->user->first_name.' '.$comment->user->last_name }}</a>
                    </h5>
                    <p>{{ $comment->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>
@include('footer')
