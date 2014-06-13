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
		$data['comments'] = $this->image->find($id)
							->join('user', 'user.id', '=', 'image.user_id')
							->join('comment', 'comment.image_id', '=', 'image.id')
							->select('comment.id', 
								'comment.description', 
								'comment.created_at', 
								'user.first_name', 
								'user.last_name',
								'user.id')
							->orderBy('comment.created_at', 'desc')
							->take(5)
							->skip(0)
							->get();

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

	/**
	 * Add a new comment
	 * @return json
	 */
	public function addComment()
	{
		if (!Auth::check()) {
			return Response::json(array(
				'error' => Lang::get('error.need_login')
			));
		}

		$validator = Validator::make(
			array('description' => Input::get('description')),
			array('description' => 'required:max:140')
		);

		$messages = $validator->messages();

		if($validator->fails()) {
			return Response::json(array('error' => $messages->first('description')));
		}

		if(! Image::find(Input::get('image_id'))) {
			return Response::json(array('error' => Lang::get('error.image_not_exist')));
		}

		$comment_field = array();

		$comment = $this->comment;

		$comment->description = Input::get('description');
		$comment->user_id = Auth::user()->id;
		$comment->image_id = Input::get('image_id');
		$comment->active = 1;

		if ($comment->save()) {
			$comment = Comment::find($comment->id);
			$comment_field['full_name'] = $comment->user->first_name.' '.$comment->user->last_name;
			$comment_field['comment_description'] = $comment->description;
			$comment_field['created_at'] = $comment->created_at;
		} else {
			$comment_field['error'] = Lang::get('error.wrong');
		}

		return Response::json($comment_field);
	}

	/**
	 * Load more comment
	 * @return json
	 */
	public function loadMoreComment()
	{
		$validator = Validator::make(
			array(
				'page_number' => Input::get('page_number'),
				'image_id' => Input::get('image_id'),
			),
			array(
				'page_number' => 'Required:integer',
				'image_id' => 'exists:image,id',
			)
		);

		$messages = $validator->messages();

		if($validator->fails()) {
			return Response::json(array('error' => $messages->all()));
		}

		$skip = (5 * Input::get('page_number') - 5);

		$comments = Image::find(Input::get('image_id'))
					->join('user', 'user.id', '=', 'image.user_id')
					->join('comment', 'comment.image_id', '=', 'image.id')
					->select('comment.id', 
						'comment.description', 
						'comment.created_at', 
						'user.first_name', 
						'user.last_name',
						'user.id')
					->orderBy('comment.created_at', 'desc')
					->take(5)
					->skip($skip)
					->get();

		return Response::json($comments);
	}
}
