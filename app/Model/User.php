<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Klass $Klass
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Usernames can only contain letters and numbers.',
			),
			'between' => array(
				'rule' => array('between', 4, 20),
                'message' => 'Usernames must be between 4 and 20 characters.',
			),
		),
		'password' => array(
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Passwords must be 6 characters or longer.',
			),
		),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'normal')),
                'allowEmpty' => false
            )
        ),
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Klass' => array(
			'className' => 'Klass',
			'joinTable' => 'users_klasses',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'klass_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

    public function beforeSave($options = array()) {
        $password = $this->data[$this->alias]['password'];
        if (isset($password)) {
            $hasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $hasher->hash($password);
        }

        return true;
    }

    public function hasClass($uid, $class_id) {
        return $this->UsersKlass->hasAny(array(
            'UsersKlass.user_id' => $uid,
            'UsersKlass.klass_id' => $class_id
        ));
    }

    /**
     * Get the instances in which the user was enrolled in the given class.
     */
    public function getEnrollments($uid, $kid) {
        return $this->UsersKlass->find('all', array(
            'fields' => array('UsersKlass.year', 'UsersKlass.quarter'),
            'conditions' => array(
                'UsersKlass.user_id' => $uid,
                'UsersKlass.klass_id' => $kid
            )
        ));
    }

}
