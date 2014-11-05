<?php
App::uses('Cupcake', 'Model');

/**
 * Cupcake Test Case
 *
 */
class CupcakeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cupcake'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cupcake = ClassRegistry::init('Cupcake');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cupcake);

		parent::tearDown();
	}

}
