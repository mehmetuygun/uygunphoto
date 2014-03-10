<?php

class AdminComponentController extends BaseController 
{
	public function Banner()
	{	
		$data = array();

		$data['banners'] = Banner::paginate(10);

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_banner.js");

		return View::make('admin/component_banner')->with($data);
	}

	public function Active()
	{
		$json = array();
		$json['e'] = 0;

		$banner = Banner::find(Input::get('banner_id'));

		if(Input::get('active') == 1) {
			$banner->active = 1;
		} elseif (Input::get('active') == 0) {
			$banner->active = 0;
		} else {
			$json['e'] = 0;
			$json['message'] = Lang::get('admin.went_wrong');
		}

		if($banner->save()) {
			$json['message'] = Lang::get('admin.update_message');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}
}
