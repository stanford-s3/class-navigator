<?php
/**
 * KlassCodeFixture
 *
 */
class KlassCodeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'klass_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'department_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'klass_code' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'klass_id' => 1,
			'department_id' => 1,
			'klass_code' => 1
		),
	);

}
