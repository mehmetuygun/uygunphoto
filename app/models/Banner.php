<?php

class Banner extends Eloquent 
{
	protected $table = 'banner';

	public function images()
	{
		return $this->hasMany('Image');
	}
}
