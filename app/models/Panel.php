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
}
