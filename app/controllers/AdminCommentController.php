<?php

class AdminCommentController extends BaseController 
{
	public function Index()
	{	
		$data = array();

		$data['comments'] = Comment::paginate(10);

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_comment.js");

		return View::make('admin/comment')->with($data);
	}

	public function Active()
	{
		$json = array();
		$json['e'] = 0;

		$comment = Comment::find(Input::get('comment_id'));

		if(Input::get('active') == 1) {
			$comment->active = 1;
		} elseif (Input::get('active') == 0) {
			$comment->active = 0;
		} else {
			$json['e'] = 0;
			$json['message'] = Lang::get('admin.went_wrong');
		}

		if($comment->save()) {
			$json['message'] = Lang::get('admin.update_message');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}

	public function Edit($id)
	{
		$data = array();

		$data['comment'] = Comment::find($id);

		if(Request::isMethod('post')) {

		}

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js");

		return View::make('admin/comment_edit')->with($data);
	}

	public function Delete()
	{
		$json = array();

		$json['e'] = 0;

		$comment = Comment::find(Input::get('comment_id'));

		if($comment->delete()) {
			$json['message'] = Lang::get('admin.message_delete');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}
}