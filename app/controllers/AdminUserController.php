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

	public function Edit($id)
	{
		$data = array();

		$data['user'] = User::find($id);

		if(Request::isMethod('post')) {
			$rules = array(
				'first_name' => 'required|alpha|digits_between:2,64',
				'last_name' => 'required|alpha|digits_between:2,64',
				'email' => 'required|email|unique:user',
			);

			$label = array(
				'first_name' => Lang::get('admin.first_name'),
				'last_name' => Lang::get('admin.last_name'),
				'email' => Lang::get('admin.email'),
			);

			foreach ($rules as $key => $value) {
				if($data['user']->$key == Input::get($key))
					unset($rules[$key]);
			}			

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
			} else {
				$user = User::find($id);
				$user->first_name = Input::get('first_name');
				$user->last_name = Input::get('last_name');
				$user->email = Input::get('email');
				if($user->save()) {
					Input::flash();
					$data['is_message'] = true;
					$data['alert_message'] = Lang::get('admin.update_message');
					$data['alert_type'] = "alert-success";
					$data['alert_name'] = Lang::get('admin.message');
				} else {
					$data['is_message'] = true;
					$data['alert_message'] = Lang::get('admin.went_wrong');
					$data['alert_type'] = "alert-danger";
					$data['alert_name'] = Lang::get('admin.error');
				}
			}

		}

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.js");

		return View::make('admin/user_edit')->with($data);
	}
}