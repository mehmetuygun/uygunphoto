<?php

class PanelPositionOptionsTest extends TestCase
{
	public $panel;

	public function setUp()
	{
		parent::setUp();

		$this->createApplication();
		$this->panel = new Panel;
	}

	public function tearDown()
	{
		parent::tearDown();

		DB::table('panel')->truncate();
	}

	public function testGivesAtTheBeginningOnly()
	{
		$this->seedPanelsTable(array());
		$options = $this->panel->getPositionOptions();

		$this->assertEquals(array('At the beginning'), $options);
	}

	public function testGivesKeepCurrentPositionOnly()
	{
		$this->seedPanelsTable(array(
			array('position' => 0, 'title' => 'This panel')
		));
		$options = $this->panel->getPositionOptions(0);

		$this->assertEquals(array('Keep current position'), $options);
	}

	public function testGivesKeepCurrentPositionAndAtTheEndOnly()
	{
		$this->seedPanelsTable(array(
			array('position' => 0, 'title' => 'This panel'),
			array('position' => 1, 'title' => 'Other panel'),
		));
		$options = $this->panel->getPositionOptions(0);

		$this->assertEquals(array(
			'Keep current position',
			2 => 'At the end',
		), $options);
	}

	public function testGivesAtTheBeginningAndAtTheEndOnly()
	{
		$this->seedPanelsTable(array(
			array('position' => 1, 'title' => 'This panel'),
			array('position' => 2, 'title' => 'Other panel'),
		));
		$options = $this->panel->getPositionOptions();

		$this->assertEquals(array(
			1 => 'At the beginning',
			2 => 'Before Other panel',
			3 => 'At the end',
		), $options);
	}

	/**
	 * @dataProvider panelPosAndExpectedOptionsProvider
	 */
	public function testGivesNormalResults($panelPos, $expectedOptions)
	{
		$this->seedPanelsTable($this->getNicePanelList());
		$options = $this->panel->getPositionOptions($panelPos);

		$this->assertEquals($expectedOptions, $options);
	}

	public function panelPosAndExpectedOptionsProvider()
	{
		return array(
			array(null, array(
				1 => 'At the beginning',
				2 => 'Before Second Panel',
				3 => 'Before Third Panel',
				4 => 'At the end',
			)),
			array(1, array(
				1 => 'Keep current position',
				3 => 'Before Third Panel',
				4 => 'At the end',
			)),
			array(1, array(
				1 => 'Keep current position',
				3 => 'Before Third Panel',
				4 => 'At the end',
			)),
			array(2, array(
				1 => 'At the beginning',
				2 => 'Keep current position',
				4 => 'At the end',
			)),
			array(3, array(
				1 => 'At the beginning',
				2 => 'Before Second Panel',
				3 => 'Keep current position',
			)),
		);
	}

	private function seedPanelsTable($panelList)
	{
		// Unguard model to avoid MassAssignmentException
		Panel::unguard();
		foreach ($panelList as $panel) {
			Panel::create($panel);
		}
	}

	private function getNicePanelList()
	{
		return array(
			array('position' => 1, 'title' => 'First Panel'),
			array('position' => 2, 'title' => 'Second Panel'),
			array('position' => 3, 'title' => 'Third Panel'),
		);
	}
}
