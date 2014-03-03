<?php
App::uses('Klass', 'Model');

/**
 * Klass Test Case
 *
 */
class KlassTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.klass',
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
		$this->Klass = ClassRegistry::init('Klass');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Klass);

		parent::tearDown();
	}

}
