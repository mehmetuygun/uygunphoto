<?php

class Panel extends Eloquent 
{
	protected $table = 'panel';

	public function images()
	{
		return $this->hasMany('PanelImage');
	}

	public static function getTypes()
	{
		return array(
			1 => 'Custom',
			2 => 'Most Commented',
			3 => 'Latest Added',
		);
	}

	public function getImageIds()
	{
		$panelImages = $this->images->toArray();

		$panelImageIds = array_map(function($var) {
			return $var['image_id'];
		}, $panelImages);

		return implode(',', $panelImageIds);
	}

}
