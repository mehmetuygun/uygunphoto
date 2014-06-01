<?php

class Panel extends Eloquent 
{
	protected $table = 'panel';

	public function images()
	{
		return $this->hasMany('PanelImage');
	}

	public function types()
	{
		return array(
			1 => 'Custom',
			2 => 'Most Commented',
			3 => 'Latest Added',
			);
	}

	public function getImagesString($id)
	{
		$panelImages = PanelImage::select('image_id')
			->where('panel_id', '=', $id)
			->get()
			->toArray();
		$panelImageIds = array_map(function($var) {
			return $var['image_id'];
		}, $panelImages);

		return implode(',', $panelImageIds);
	}

}
