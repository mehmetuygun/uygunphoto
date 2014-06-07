<?php

class PanelTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		DB::table('panel_image')->truncate();
		DB::table('panel')->truncate();
		DB::table('image')->truncate();
	}

	public function testPanelImageRelation()
	{
		$panel = new Panel;
		$panel->title = 'New Panel';
		$panel->save();

		$image = new Image;
		$panelImage = new PanelImage;
		$image->save();
		$panelImage->image()->associate($image);
		$panel->images()->save($panelImage);

		$panelImages = $panel->images();

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $panelImages);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $panelImages->get());
		$this->assertCount(1, $panelImages->get()->toArray());
	}

	public function testGetsImageIds()
	{
		$panel = new Panel;
		$panel->title = 'New Panel';
		$panel->save();
		$imageIds = '';
		for ($i = 0; $i < 3; $i++) {
			$image = new Image;
			$panelImage = new PanelImage;
			$image->save();
			$imageIds .= $image->id . ',';
			$panelImage->image()->associate($image);
			$panel->images()->save($panelImage);
		}
		$imageIds = substr($imageIds, 0, -1);

		$this->assertEquals($imageIds, $panel->getImageIds());
	}

	public function testGetsPanelTypes()
	{
		$types = Panel::getTypes();

		$this->assertInternalType('array', $types);
		$this->assertNotEmpty($types);
	}
}
