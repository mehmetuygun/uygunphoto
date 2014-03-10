<?php

class AdminSystemController extends BaseController 
{
	public function Configuration()
	{
		$data = array();

		$data['configuration'] = Configuration::find(1);


		if(Request::isMethod('post')) {
			$rules = array(
				'meta_title' => 'required|digits_between:1,32',
				'meta_description' => 'required|digits_between:1,64',
			);

			$label = array(
				'meta_title' => Lang::get('admin.meta_title'),
				'meta_description' => Lang::get('admin.meta_description'),
			);

			foreach ($rules as $key => $value) {
				if($data['configuration']->$key == Input::get($key))
					unset($rules[$key]);
			}			

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
			} else {
				$configuration = Configuration::find(1);
				$configuration->meta_title = Input::get('meta_title');
				$configuration->meta_description = Input::get('meta_description');
				if($configuration->save()) {
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

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js");

		return View::make('admin/system_configuration')->with($data);
	}
}