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
				$user->first_name = ucfirst(strtolower(Input::get('first_name')));
				$user->last_name = ucfirst(strtolower(Input::get('last_name')));
				$user->email = Input::get('email');
				if($user->save()) {
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

		return View::make('admin/user_edit')->with($data);
	}

	public function Profile()
	{

		$data = array();

		$data['user'] = User::find(Auth::user()->id);

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
				$user = User::find(Auth::user()->id);
				$user->first_name = ucfirst(strtolower(Input::get('first_name')));
				$user->last_name = ucfirst(strtolower(Input::get('last_name')));
				$user->email = Input::get('email');
				if($user->save()) {
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

		return View::make('admin/user_profile')->with($data);
	}
	public function Password()
	{

		$data = array();
		$data['alert'] = 0;

		if(Request::isMethod('post')) {
			$rules = array(
				'current_password' => 'required|passcheck',
				'new_password' => 'required|alpha_dash|digits_between:8,64',
				'confirm_password' => 'required|same:new_password',
			);

			$label = array(
				'current_password' => Lang::get('admin.password'),
				'confirm_password' => Lang::get('admin.confirm_password'),
				'new_password' => Lang::get('admin.new_password'),
			);

			Validator::extend('passcheck', function($attribute, $value, $parameters)
			{
				if (Hash::check(Input::get('current_password'), User::find(Auth::user()->id)->getAuthPassword())) {
					return true;
				}
				else {
					return false;
				}
			});
			$validator = Validator::make(Input::all(), $rules, array('passcheck'=>Lang::get('admin.password_validation_error')), $label);



			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
			} else {
				$user = User::find(Auth::user()->id);
				$user->password = Hash::make(Input::get('new_password'));
				if($user->save()) {
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

		return View::make('admin/user_password')->with($data);
	}
}