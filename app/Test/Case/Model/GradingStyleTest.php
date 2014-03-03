<?php
App::uses('GradingStyle', 'Model');

/**
 * GradingStyle Test Case
 *
 */
class GradingStyleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.grading_style'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GradingStyle = ClassRegistry::init('GradingStyle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GradingStyle);

		parent::tearDown();
	}

}
