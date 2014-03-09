<?php

class AdminUserController extends BaseController 
{
	public function Index()
	{	
		$data = array();

		$data['users'] = User::paginate(10);
		
		$data["js"] = array("js/jquery-1.11.0.min.js", "bootstrap/js/bootstrap.min.js");

		return View::make('admin/user')->with($data);
	}
}