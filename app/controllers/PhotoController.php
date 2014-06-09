<?php

class PhotoController extends BaseController {

	protected $image;
	protected $comment;
	protected $user;

	public function __construct(Image $image, Comment $comment, User $user)
	{
		$this->image = $image;
		$this->comment = $comment;
		$this->user = $user;
	}

	public function Home($id)
	{

		$data = array(
			"js" => array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/xhr2.js", "js/upload.js", "js/photo.js")
		);

		$image = $this->image->find($id);

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

		$user = $this->user->find($id);

		$data['images'] = $this->image->where('user_id', '=', $user->id)->paginate(8);
		$data['user'] = $user;

		return View::make('profile')->with($data);

	}

	public function Comment()
	{
		if (!Auth::check()) {
			return Response::json(array(
				'error' => Lang::get('error.need_login')
			));
		}

		$json = array();
		$comment = $this->comment;
		$comment->description = Input::get('description');
		$comment->user_id = Auth::user()->id;
		$comment->image_id = Input::get('image_id');

		if ($comment->save()) {
			$user = $comment->user;
			$json['full_name'] = $user->first_name.' '.$user->last_name;
			$json['comment_description'] = $comment->description;
			$json['created_at'] = $comment->created_at;
		} else {
			$json['error'] = Lang::get('error.wrong');
		}

		return Response::json($json);
	}
}
