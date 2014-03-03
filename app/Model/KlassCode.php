<?php
App::uses('AppModel', 'Model');
/**
 * KlassCode Model
 *
 * @property Klass $Klass
 * @property Department $Department
 */
class KlassCode extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'klass_code' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Klass' => array(
			'className' => 'Klass',
			'foreignKey' => 'klass_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
