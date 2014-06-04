<?php

class AdminComponentController extends BaseController
{
	public function panel()
	{
		$data = array(
			'panels' => Panel::orderBy('position')->paginate(25),
			'js' => array(
				'js/jquery-1.11.0.min.js',
				'bootstrap/js/bootstrap.min.js',
				'js/admin_panel.js',
			),
			'alert' => Session::get('alert.alert'),
			'alert_message' => Session::get('alert.alert_message'),
			'alert_type' => Session::get('alert.alert_type'),
		);

		return View::make('admin/component_panel')->with($data);
	}

	public function panelAdd()
	{
		$data = $this->getPanelViewData();

		// If request method is not post just load the view
		if (!Request::isMethod('post')) {
			return View::make('admin/component_panel_add')
				->with($data);
		}

		$validator = $this->getPanelValidator();
		if ($validator->fails()) {
			$data['messages'] = $validator->messages();
			Input::flash();
			return View::make('admin/component_panel_add')
				->with($data);
		}

		$panel = new Panel;
		$this->createUpdatePanel($panel);

		Session::flash('alert', array(
			'alert' => 1,
			'alert_message' => Lang::get('admin.alert_added_success'),
			'alert_type' => 'alert-success',
		));

		return Redirect::action('AdminComponentController@panel');
	}

	public function panelEdit($id)
	{
		$data = $this->getPanelViewData();

		// If request method is not post just load the view
		if (!Request::isMethod('post')) {
			$panel = Panel::find($id);

			$data['panel'] = $panel;
			$data['images'] = $panel->getImageIds();
			$data['positions'] = Panel::getPositionOptions($panel->position);
			return View::make('admin/component_panel_edit')
				->with($data);
		}

		$validator = $this->getPanelValidator();
		if ($validator->fails()) {
			$data['messages'] = $validator->messages();
			Input::flash();

			$panel = Panel::find($id);
			$data['panel'] = $panel;
			$data['images'] = $panel->getImageIds();
			$data['positions'] = Panel::getPositionOptions($panel->position);
			return View::make('admin/component_panel_edit')
				->with($data);
		}

		$panel = Panel::find($id);
		$this->createUpdatePanel($panel);

		$panel = Panel::find($id);
		$data['panel'] = $panel;
		$data['images'] = $panel->getImageIds();
		$data['positions'] = Panel::getPositionOptions($panel->position);

		return View::make('admin/component_panel_edit')
			->with($data);
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
			return (bool) Panel::where('position', '>=', $position)
				->increment('position');
		}

		$panel = Panel::find($panelId);
		$prevPos = $panel->position;
		if ($position < $prevPos) {
			Panel::where('position', '>=', $position)
				->where('position', '<', $prevPos)
				->increment('position');
		} elseif ($position > $prevPos) {
			Panel::where('position', '<=', $position)
				->where('position', '>', $prevPos)
				->decrement('position');
		}

		$panel->position = $position;
		return $panel->save();
	}

	/**
	 * Get validator instance to be used in panel add / edit
	 *
	 * @return Illuminate\Validation\Validator
	 */
	private function getPanelValidator()
	{
		$rules = array(
			'title' => 'required|alpha_dash|digits_between:2,64',
		);

		$label = array(
			'title' => Lang::get('title'),
		);

		if (Input::get('type') == 1) {
			$rules['image'] = 'required';
			$label['image'] = Lang::get('admin.select_photos');
		}

		return Validator::make(Input::all(), $rules, array(), $label);
	}

	/**
	 * Create / Update Panel used in panel add /edit
	 *
	 * @param  Panel $panel  Panel to be modified
	 *
	 * @return bool          True if updated successfully
	 */
	private function createUpdatePanel($panel)
	{
		$panel->title = Input::get('title');
		$panel->position = Input::get('position');
		$panel->type = Input::get('type');
		$this->reorderPanels($panel->position, $panel->id);
		if (!$panel->save()) {
			return false;
		}

		$panel->images()->delete();
		if (Input::get('type') == 1) {
			$count = 1;
			$values = Input::get('image');
			$values = explode(',', $values);
			foreach ($values as $value) {
				$panelImage = new PanelImage;
				$panelImage->panel_id = $panel->id;
				$panelImage->image_id = $value;
				$panelImage->position = $count++;
				$panelImage->save();
			}
		}

		return true;
	}

	/**
	 * Get data for add / edit views
	 *
	 * @return array Data to be sent to the view
	 */
	private function getPanelViewData()
	{
		return array(
			'js' => array(
				'js/jquery-1.11.0.min.js',
				'bootstrap/js/bootstrap.min.js',
				'js/admin_panel.js',
				'js/select2.min.js',
				'js/jquery-ui-1.10.4.custom.min.js',
			),
			'css' => array(
				'css/select2.css',
				'css/ui-lightness/jquery-ui-1.10.4.custom.min.css',
			),
			'types' => Panel::getTypes(),
			'positions' => Panel::getPositionOptions(),
		);
	}
}
