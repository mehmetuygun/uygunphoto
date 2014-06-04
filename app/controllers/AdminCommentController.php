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
			$rules = array(
				'description' => 'required|between:1,255',
				'active' => 'required|in:1,0'
			);

			$label = array(
				'description' => Lang::get('admin.comment_description'),
				'active' => Lang::get('admin.comment_active')
			);

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
			} else {
				$comment = Comment::find($id);
				$comment->description = Input::get('description');
				$comment->active = Input::get('active');
				if($comment->save()) {
					Input::flash();
					$data['alert'] = true;
					$data['alert_message'] = Lang::get('admin.update_message');
					$data['alert_type'] = "alert-success";
				} else {
					$data['alert'] = true;
					$data['alert_message'] = Lang::get('admin.went_wrong');
					$data['alert_type'] = "alert-danger";
				}
			}

		}

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.js");

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