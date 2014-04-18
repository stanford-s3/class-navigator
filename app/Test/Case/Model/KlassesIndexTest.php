<?php
App::uses('KlassesIndex', 'Model');

/**
 * KlassesIndex Test Case
 *
 */
class KlassesIndexTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.klasses_index',
		'app.class',
		'app.grading_style',
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
		$this->KlassesIndex = ClassRegistry::init('KlassesIndex');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KlassesIndex);

		parent::tearDown();
	}

}
