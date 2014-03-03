<?php
App::uses('AppModel', 'Model');
/**
 * Klass Model
 *
 * @property User $User
 */
class Klass extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


/**
 * hasOne associations
 *
 * @var array
 */
    public $hasOne = 'GradingStyle';


/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'KlassCode' => array(
            'className' => 'KlassCode',
        )
    );


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_klasses',
			'foreignKey' => 'klass_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
