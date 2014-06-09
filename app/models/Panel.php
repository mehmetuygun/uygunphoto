<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

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
			3 => 'Recently Added',
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

	/**
	 * Get position options for the views
	 *
	 * @param  integer $curPos Current position of the panel being edited
	 *
	 * @return array           List of position options
	 */
	public static function getPositionOptions($curPos = null)
	{
		$panelList = self::orderBy('position')
			->get()
			->toArray();

		if (!$panelList) {
			return array('At the beginning');
		}

		$options = array();
		foreach ($panelList as $panel) {
			$position = $panel['position'];
			if (!empty($skipNext)) {
				$skipNext = false;
				continue;
			}
			if (!isset($minPos)) {
				$minPos = $position;
			}
			if (isset($curPos) && $curPos == $position) {
				$skipNext = true;
			}
			$options[$position] = "Before {$panel['title']}";
		}

		$options[$minPos] = 'At the beginning';
		if ($position != $curPos) {
			$options[$position+1] = 'At the end';
		}
		if (isset($curPos)) {
			$options[$curPos] = 'Keep current position';
		}

		return $options;
	}
}
