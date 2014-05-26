<?php

class AdminComponentController extends BaseController 
{
	public function panel()
	{	
		$data = array();

		$data['panels'] = Panel::paginate(10);

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_panel.js");

		return View::make('admin/component_panel')->with($data);
	}

	public function active()
	{
		$json = array();
		$json['e'] = 0;

		$panel = panel::find(Input::get('panel_id'));

		if(Input::get('active') == 1) {
			$panel->active = 1;
		} elseif (Input::get('active') == 0) {
			$panel->active = 0;
		} else {
			$json['e'] = 0;
			$json['message'] = Lang::get('admin.went_wrong');
		}

		if($panel->save()) {
			$json['message'] = Lang::get('admin.update_message');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}
}
