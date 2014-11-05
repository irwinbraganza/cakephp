<?php
/**
 * LeaveFixture
 *
 */
class LeaveFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'uid' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'reason' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'startdate' => array('type' => 'date', 'null' => false, 'default' => null),
		'enddate' => array('type' => 'date', 'null' => false, 'default' => null),
		'totaldays' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uid' => array('column' => 'uid', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'uid' => 1,
			'reason' => 'Lorem ipsum dolor sit amet',
			'startdate' => '2014-08-19',
			'enddate' => '2014-08-19',
			'totaldays' => 1
		),
	);

}
