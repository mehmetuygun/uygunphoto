<?php

class AdminComponentController extends BaseController 
{
	public function Banner()
	{
		return View::make('admin/component_banner');
	}
}
