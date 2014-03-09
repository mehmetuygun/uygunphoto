<?php

class AdminPhotoController extends BaseController 
{
	public function Index()
	{	
		$data = array();

		$data['photos'] = Image::paginate(10);

		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js", "js/admin_image.js");

		return View::make('admin/photo')->with($data);
	}

	public function Active()
	{
		$json = array();
		$json['e'] = 0;

		$photo = Image::find(Input::get('image_id'));

		if(Input::get('active') == 1) {
			$photo->active = 1;
		} elseif (Input::get('active') == 0) {
			$photo->active = 0;
		} else {
			$json['e'] = 0;
			$json['message'] = Lang::get('admin.went_wrong');
		}

		if($photo->save()) {
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

		$data['photo'] = Image::find($id);

		if(Request::isMethod('post')) {
			$rules = array(
				'title' => 'required|between:1,64',
				'active' => 'required|in:1,0'
			);

			$label = array(
				'title' => Lang::get('admin.photo_title'),
				'active' => Lang::get('admin.photo_active')
			);

			$validator = Validator::make(Input::all(), $rules, array(), $label);

			$data['messages'] = $validator->messages();

			if ($validator->fails()) {
				Input::flash();
			} else {
				$photo = Image::find($id);
				$photo->title = Input::get('title');
				$photo->active = Input::get('active');
				if($photo->save()) {
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

		return View::make('admin/photo_edit')->with($data);
	}

	public function Delete()
	{
		$json = array();

		$json['e'] = 0;

		$photo = Image::find(Input::get('image_id'));

		if($photo->delete() 
			&& File::delete(public_path('/img/original/'.$photo->original_name))
			&& File::delete(public_path('/img/thumbnail/'.$photo->thumbnail_name))
			&& File::delete(public_path('/img/web/'.$photo->web_name)) ) {
			$json['message'] = Lang::get('admin.message_delete');
			$json['e'] = 1;
		} else {
			$json['message'] = Lang::get('admin.went_wrong');
			$json['e'] = 0;
		}

		return Response::json($json);
	}
}