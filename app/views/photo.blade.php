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
                @foreach ($image->comment as $comment)
                    <div class="media">
                        <a class="pull-left" href="{{ url('/profile/'.$image->user->id) }}">
                            <img class="media-object" src="{{ url('/img/avatar/user-32.png') }}" >
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="">{{ $comment->user->first_name.' '.$comment->user->last_name }}
                                </a> 
                                <span class="sub-text">{{ $comment->created_at }}</span>
                            </h5>
                            <span class="comment-text">{{ $comment->description }}</span>
                        </div>
                    </div>   
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
        footer
        </div>
    </div>
</div>
@include('footer')
