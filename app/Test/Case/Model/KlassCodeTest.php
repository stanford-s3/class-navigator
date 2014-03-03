<?php
App::uses('KlassCode', 'Model');

/**
 * KlassCode Test Case
 *
 */
class KlassCodeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.klass_code',
		'app.klass',
		'app.user',
		'app.users_klass',
		'app.department'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->KlassCode = ClassRegistry::init('KlassCode');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KlassCode);

		parent::tearDown();
	}

}
