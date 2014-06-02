<?php

class AdminComponentController extends BaseController 
{
	public function panel()
	{	
		$data = array();

		$data['panels'] = Panel::paginate(25);

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_panel.js");

		$data['alert'] = Session::get('alert.alert');
		$data['alert_message'] = Session::get('alert.alert_message'); 
		$data['alert_type'] = Session::get('alert.alert_type'); 
		return View::make('admin/component_panel')->with($data);
	}	

	public function panelAdd()
	{	
		$panel = new Panel;

		$data['js'] = array(
			"js/jquery-1.11.0.min.js", 
			"bootstrap/js/bootstrap.min.js", 
			"js/admin_panel.js", 
			"js/select2.min.js",
			"js/jquery-ui-1.10.4.custom.min.js"
		);
		$data['css'] = array('css/select2.css', 'css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
		$data['types'] = $panel->types();

		$success_message = array(
			'alert' => 1,
			'alert_message' => Lang::get('admin.alert_added_success'),
			'alert_type' => 'alert-success',
		);

		if(Request::isMethod('post')) {

			$rules = array(
				'title' => 'required|alpha_dash|digits_between:2,64',
			);


			$label = array(
				'title' => Lang::get('title'),
			);

			if(Input::get('type')) {
				$rules['image'] = 'required';
				$label['image'] = Lang::get('admin.select_photos');
			}

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			if ($validator->fails()) {
				$data['messages'] = $validator->messages();
				Input::flash();
			} else {
				$panel = new Panel;
				$panel->title = Input::get('title');
				$panel->sort = 0;
				$panel->type = Input::get('type');
				if($panel->save() && Input::get('type')) {
					$count = 1;
					$values = Input::get('image');
					$values = explode(',', $values);
					foreach($values as $value) {
						$PanelImage = new PanelImage;
						$PanelImage->panel_id = $panel->id;
						$PanelImage->image_id = $value;
						$PanelImage->sort = $count;
						$count++;
						if($PanelImage->save()) {
							$PanelImageSave = true;
						}
					}
					if($PanelImageSave) {
						Session::flash('alert', $success_message);
						return Redirect::action('AdminComponentController@panel', array(), 303);
					}
				}
				Session::flash('alert', $success_message);
				return Redirect::action('AdminComponentController@panel', array(), 303);
			}

		}

		return View::make('admin/component_panel_add')->with($data);
	}

	public function panelEdit($id)
	{

		$data['js'] = array(
			"js/jquery-1.11.0.min.js", 
			"bootstrap/js/bootstrap.min.js", 
			"js/admin_panel.js", 
			"js/select2.min.js",
			"js/jquery-ui-1.10.4.custom.min.js"
		);

		$data['css'] = array('css/select2.css', 'css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
		

		if(Request::isMethod('post')) {

			$rules = array(
				'title' => 'required|alpha_dash|digits_between:2,64',
			);


			$label = array(
				'title' => Lang::get('title'),
			);

			if(Input::get('type')) {
				$rules['image'] = 'required';
				$label['image'] = Lang::get('admin.select_photos');
			}

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			if ($validator->fails()) {
				$data['messages'] = $validator->messages();
				Input::flash();
			} else {
				$panel = Panel::find($id);
				$panel->title = Input::get('title');
				$panel->sort = 0;
				$panel->type = Input::get('type');
				if($panel->save() && Input::get('type')) {
					if(Input::get('type') == 1) {
						$count = 1;
						$values = Input::get('image');
						$values = explode(',', $values);
						$PanelImageOld = PanelImage::Where('panel_id', '=', $panel->id);
						$PanelImageOld->delete();
						foreach($values as $value) {
							$PanelImage = new PanelImage;
							$PanelImage->panel_id = $panel->id;
							$PanelImage->image_id = $value;
							$PanelImage->sort = $count;
							$count++;
							if($PanelImage->save()) {
								$PanelImageSave = true;
							}
						}
					}

					if(Input::get('type') != 1) {
						$PanelImageOld = PanelImage::Where('panel_id', '=', $panel->id);
						$PanelImageOld->delete();
						$PanelImageSave = true;
					}

					if($PanelImageSave) {
						$data['alert'] = 1;
						$data['alert_message'] = Lang::get('admin.alert_updated_success');
						$data['alert_type'] = 'alert-success';

					}
				} // end of panel save
			} // end of else 
		} // end of post

		$panel = Panel::find($id);

		$p = new Panel;

		$data['panel'] = $panel;
		$data['types'] = $panel->types();
		$data['images'] = $p->getImagesString($id);
		return View::make('admin/component_panel_edit')->with($data);
	}

	public function active()
	{
		$json = array();
		$json['e'] = 0;

		$panel = Panel::find(Input::get('panel_id'));

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

	public function delete()
	{
		$json = array();
		$json['e'] = 0;

		$panel = Panel::find(Input::get('panel_id'));

		if($panel->delete()) {
			$json['e'] = 1;
			$json['message'] = Lang::get('admin.message_delete');
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
		}

		return Response::json($json);
	}

	/**
	 * Re-order panels using the position and panel ID
	 * When no panel ID given it reserves the given position
	 *
	 * @param  integer $position New position of the panel
	 * @param  integer $panelId  Panel ID
	 *
	 * @return bool              Success
	 */
	private function reorderPanels($position, $panelId = null)
	{
		// If no panelId given, reserve the given position
		if (!$panelId) {
			return (bool) Panel::where('sort', '>=', $position)
				->increment('sort');
		}

		$panel = Panel::find($panelId);
		$prevPos = $panel->sort;
		if ($position < $prevPos) {
			Panel::where('sort', '>=', $position)
				->where('sort', '<', $prevPos)
				->increment('sort');
		} elseif ($position > $prevPos) {
			Panel::where('sort', '<=', $position)
				->where('sort', '>', $prevPos)
				->decrement('sort');
		}

		$panel->sort = $position;
		return $panel->save();
	}
}
