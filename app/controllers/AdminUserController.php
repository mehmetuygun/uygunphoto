<?php

class AdminUserController extends BaseController 
{
	public function Index()
	{	
		$data = array();

		$data['users'] = User::paginate(10);
		
		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_user.js");

		return View::make('admin/user')->with($data);
	}

	public function Delete()
	{
		$json = array();

		$json['e'] = 0;

		$user = User::find(Input::get('user_id'));

		if($user->delete()) {
			$json['message'] = Lang::get('admin.message_delete');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}
}