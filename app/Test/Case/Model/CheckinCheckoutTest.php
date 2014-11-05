<?php
App::uses('CheckinCheckout', 'Model');

/**
 * CheckinCheckout Test Case
 *
 */
class CheckinCheckoutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.checkin_checkout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CheckinCheckout = ClassRegistry::init('CheckinCheckout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CheckinCheckout);

		parent::tearDown();
	}

}
