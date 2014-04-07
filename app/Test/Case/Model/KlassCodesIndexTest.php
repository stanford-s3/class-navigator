<?php
App::uses('KlassCodesIndex', 'Model');

/**
 * KlassCodesIndex Test Case
 *
 */
class KlassCodesIndexTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.klass_codes_index',
		'app.class',
		'app.grading_style',
		'app.klass_code',
		'app.department',
		'app.user',
		'app.users_klass'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->KlassCodesIndex = ClassRegistry::init('KlassCodesIndex');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KlassCodesIndex);

		parent::tearDown();
	}

}
