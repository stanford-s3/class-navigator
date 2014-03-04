<?php
App::uses('AppModel', 'Model');
App::uses('Department', 'Model');
/**
 * Klass Model
 *
 * @property User $User
 */
class Klass extends AppModel {

    public $uses = array('Department');

    public $name = 'Class';
    public $useTable = 'klasses';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


    public $virtualFields = array(
        'units' => 'IF(units_max IS NULL, units_min, CONCAT(units_min, "–", units_max))'
    );


    public $belongsTo = 'GradingStyle';


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

    private $Department;

    /**
     * Returns an array of class codes which describe this class.
     *
     * @return array
     */
    public function getCodeNames($codes) {
        if (!isset($this->Department))
            $this->Department = new Department();

        $ret = array();
        foreach ($codes as $code) {
            $department = $this->Department->find('first', array('conditions' => array('Department.id' => $code['department_id'])));
            $ret[] = $department['Department']['code'] . ' ' . $code['klass_code'];
        }

        return $ret;
    }

}
