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
</div>
@include('footer')
