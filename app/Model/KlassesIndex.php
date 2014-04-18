<?php
App::uses('AppModel', 'Model');
/**
 * KlassesIndex Model
 *
 * @property Klass $Klass
 */
class KlassesIndex extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'klasses_index';


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
		)
	);
}
