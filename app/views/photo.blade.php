@include('header')
<div class="panel panel-default panel-uygunphoto panel-photo">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $image->title }} 
        </h3>
    </div>
    <div class="photo_box">
        <img src="{{url('/img/web/'.$image->web_name)}}" class="web_image"/>
    </div>
</div>
    <div class="panel panel-default panel-comment">
        <div class="panel-heading">
            <h3 class="panel-title">
                <!-- <span class="glyphicon glyphicon-comment"></span> -->
                Comment
                <span class="label label-info">{{ $image->comment->count() }}</span>
            </h3>
        </div>
        <div class="panel-body">
            <form id="comment_form">
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="comment_save">Add</button>
                    </span>
                    <input type="text" name="description" class="form-control" id="comment_description" placeholder="Write a comment">
                </div>
                
            </form>
            <div class="comment-box">
                @foreach ($comments as $comment)
                    <div class="media">
                        <a class="pull-left" href="{{ url('/profile/'.$comment->id) }}">
                            <img class="media-object" src="{{ url('/img/avatar/user-32.png') }}" >
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="">{{ $comment->first_name.' '.$comment->last_name }}
                                </a> 
                                <span class="sub-text">{{ $comment->created_at }}</span>
                            </h5>
                            <span class="comment-text">{{ $comment->description }}</span>
                        </div>
                    </div>   
                @endforeach
            </div>
            <form id="load_more_comments_form">
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <input type="hidden" name="page_number" value="2" id="page_number">
            </form>
            <button type="button" class="btn btn-info" style="width:100%" id="load_more_comments">{{ trans('common.load_more') }}</button>
        </div>
    </div>
</div>
@include('footer')
