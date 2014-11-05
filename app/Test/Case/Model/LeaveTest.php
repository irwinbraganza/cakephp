<?php
App::uses('Leave', 'Model');

/**
 * Leave Test Case
 *
 */
class LeaveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.leave'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Leave = ClassRegistry::init('Leave');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Leave);

		parent::tearDown();
	}

}
