<?php

class PhotoController extends BaseController {

	public function Home($id)
	{

		$data = array(
			"js" => array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/xhr2.js", "js/upload.js", "js/photo.js")
		);

		$image = Image::find($id);

		$data['image'] = $image;
		$data['user'] = $image->user;
		$data['comment'] = $image->comment;

		return View::make('photo')->with($data);
	}

	public function Profile($id)
	{
		$data = array(
			"js" => array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/xhr2.js", "js/upload.js", "js/photo.js")
		);

		$user = User::find($id);

		$data['images'] = Image::where('user_id', '=', $user->id)->paginate(8);
		$data['user'] = $user;

		return View::make('profile')->with($data);

	}

	public function Comment()
	{
		$comment = new Comment;

		$json = array();

		if(Auth::check()) {
			$comment->description = Input::get('description');
			$comment->user_id = Auth::user()->id;
			$comment->image_id = Input::get('image_id');

			if($comment->save()) {
				$user = $comment->user;
				$json['full_name'] = $user->first_name.' '.$user->last_name;
				$json['comment_description'] = $comment->description;
				$json['created_at'] = $comment->created_at;
			}
		} else {
			$json['error'] = Lang::get('error.need_login');
		}

		return Response::json($json);
	}
}
