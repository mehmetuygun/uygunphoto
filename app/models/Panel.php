<?php

class Panel extends Eloquent 
{
	protected $table = 'panel';

	public function images()
	{
		return $this->hasMany('Image');
	}
}
