<?php
App::uses('Holiday', 'Model');

/**
 * Holiday Test Case
 *
 */
class HolidayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.holiday',
		'app.leave',
		'app.user',
		'app.cupcake',
		'app.checkin_checkout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Holiday = ClassRegistry::init('Holiday');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Holiday);

		parent::tearDown();
	}

}
