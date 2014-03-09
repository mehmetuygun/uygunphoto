<?php

class AdminController extends BaseController 
{
	public function Dashboard()
	{
		$data = array();

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js");

		return View::make('admin/dashboard')->with($data);
	}

	public function Login()
	{
		$data = array();

		if (Request::isMethod('post')) {
			$input = array(
				"email" => Input::get('email'),
				"password" => Input::get('password'),
				"admin" => 1
			);

			$rules = array(
				'email' => 'required|email',
				'password' => 'required|digits_between:8,64',
			);

			$label = array(
				'email' => Lang::get('form.email'),
				'password' => Lang::get('form.password'),
			);

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
				return View::make('admin/login')->with($data);
			} elseif(Auth::attempt($input)) {
				return Redirect::to('/admin/dashboard');
			} else {
				$data['error'] = Lang::get("admin.error_login");
				Input::flash();
			}

		} 

		return View::make('admin/login')->with($data);
	}
}