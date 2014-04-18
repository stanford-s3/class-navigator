<?php
/**
 * KlassesIndexFixture
 *
 */
class KlassesIndexFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'klasses_index';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'klass_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'string' => array('type' => 'string', 'null' => false, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'string' => 'Lorem ipsum dolor sit amet'
		),
	);

}
