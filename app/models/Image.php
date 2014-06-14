<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Image extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'image';
	public $error;
	public $_web_width;
	public $_web_height;
	public $_thumbnail_name;
	public $_web_name;
	public $_original_name;

	public function upload($image_file)
	{
		if ($this->createThumbnail($image_file, $thumbnailName = uniqid(true)) 
			&& $this->webImage($image_file, $webImageName = uniqid(true)) 
			&& $this->original($image_file, $originalName = uniqid(true))
		) {
			return true;
		}

		return false;
	}

	public function original($file, $fileName)
	{
		if(Image_lib::make($file->getRealPath())->save(base_path().'/public/img/original/'.$fileName.'.jpg')) {
			$this->_original_name = $fileName.'.jpg';
			return true;
		}
		$this->error = Lang::get('error.wrong');
		return false;
	}

	public function createThumbnail($file, $fileName)
	{
		$image = Image_lib::make($file->getRealPath());

		$this->_thumbnail_name = $fileName.'.jpg';

		if($image->fit(450, 300)->save(base_path().'/public/img/thumbnail/'.$fileName.'.jpg'))
			return true;

		$this->error = Lang::get('error.wrong');
		return false;
	}

	public function webImage($file, $fileName)
	{
		$image = Image_lib::make($file->getRealPath());

		$this->_web_name = $fileName.'.jpg';

		if($image->width() > $image->height()) {
			$ratio = $image->width() / $image->height();
		} else {
			$ratio = $image->height() / $image->width();
		}

		if($image->width() > 1024) {
			$img_width = 1024;
			$img_height = 1024 / $ratio;
		} elseif($image->height() > 1024){
			$img_width = 1024 / $ratio;
			$img_height = $image->height();
		} else {
			$img_width = $image->width();
			$img_height = $image->height();
		}

		$img_height = round($img_height);
		$img_width = round($img_width);

		if($image->resize($img_width, $img_height)->save(base_path().'/public/img/web/'.$fileName.'.jpg')) {
			$this->_web_width = $img_width;
			$this->_web_height = $img_height;
			return true;
		} else {
			$this->error = Lang::get('error.wrong');
			return false;
		}
	}

	public function getImages($limit) {
		$image = Image::where('active', 1)
			->orderBy('created_at', 'DESC')
			->paginate($limit);
		return $image;
	}

	public function getLastImages($limit) {
		$image = Image::where('active', 1)
		->orderBy('created_at', 'DESC')
		->limit($limit)
		->get();
		return $image;
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function comment()
	{
		return $this->hasMany('Comment')
		->orderBy('created_at', 'desc');
	}

	public function panelimages()
	{
		return $this->hasMany('PanelImage');
	}

	public function banner()
	{
		return $this->belongsTo('banner');
	}
}

?>