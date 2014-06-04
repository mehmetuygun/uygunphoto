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
	 * @todo clean up
	 * @param  integer $curPos Panels current position for edit view
	 *
	 * @return array           List of position options
	 */
	public static function getPositionOptions($curPos = null)
	{
		$panelList = self::orderBy('position')
			->get()
			->toArray();

		$options = array();
		$getNext = false;
		foreach ($panelList as $panel) {
			if (!isset($minPos)) {
				$minPos = $panel['position'];
				if (isset($curPos) && $curPos == $minPos) {
					$getNext = true;
				}
			}
			if ($getNext && $curPos != $panel['position']) {
				$secondMin = $panel['position'];
				$getNext = false;
			}
			$options[$panel['position']] = "Before {$panel['title']}";
		}
		if (isset($minPos)) {
			$options[$minPos] = 'At the Beginning';
		}
		if (isset($secondMin)) {
			unset($options[$secondMin]);
		}
		if (isset($panel) && $panel['position'] != $curPos) {
			$options[$panel['position']+1] = 'At the End';
		}
		if (isset($curPos)) {
			$options[$curPos] = 'Keep current position';
		}
		if (!$options) {
			$options = array('At the Beginning');
		}

		return $options;
	}
}
