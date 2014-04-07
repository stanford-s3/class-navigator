<?php
/**
 * KlassCodesIndexFixture
 *
 */
class KlassCodesIndexFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'klass_codes_index';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'class_code' => array('type' => 'string', 'null' => false, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'klass_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'class_code' => array('column' => 'class_code', 'unique' => 0)
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
			'class_code' => 'Lorem ipsum dolor sit amet',
			'klass_id' => 1
		),
	);

}
