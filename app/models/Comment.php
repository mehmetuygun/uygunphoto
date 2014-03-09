<?php

class Comment extends Eloquent 
{
	protected $table = 'comment';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function image()
	{
		return $this->belongsTo('Image');
	}
}
