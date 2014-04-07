<?php
App::uses('AppModel', 'Model');
/**
 * KlassCodesIndex Model
 *
 * @property Klass $Klass
 */
class KlassCodesIndex extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'klass_codes_index';


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
