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
        ),
        'KlassCodesIndex' => array(
            'className' => 'KlassCodesIndex'
        ),
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

    /**
     * Returns an array of Klasses which match the given code lookup.
     *
     * @param string $code_query
     * @return array
     */
    public function searchByCode($code_query, $fields = null) {
        $options = array(
            'joins' => array(
                array(
                    'table' => 'klass_codes_index',
                    'alias' => 'KlassCodesIndex',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Klass.id = KlassCodesIndex.klass_id'
                    )
                )
            ),
            'conditions' => array(
                'KlassCodesIndex.class_code LIKE' => $code_query . '%'
            )
        );

        if (!empty($fields))
            $options['fields'] = $fields;

        return $this->find('all', $options);
    }

    public function addUser($kid, $uid, $year, $quarter) {
        $this->User->UsersKlass->save(array(
            'klass_id' => $kid,
            'user_id' => $uid,
            'year' => $year,
            'quarter' => $quarter
        ));
    }

    public function removeUser($kid, $uid, $year, $quarter) {
        $this->UsersKlass->deleteAll(array(
            'UsersKlass.klass_id' => $kid,
            'UsersKlass.user_id' => $uid,
            'UsersKlass.year' => $year,
            'UsersKlass.quarter' => $quarter
        ), false);
    }

    /**
     * @param $kid
     * @param $year Academic year
     * @param $quarter Quarter ID (see StanfordComponent constants, e.g.,
     *   CLASS_QUARTER_AUTUMN)
     */
    public function getUsers($kid, $year = null, $quarter = null) {
        $conditions = array(
            'UsersKlass.klass_id' => $kid,
            'UsersKlass.user_id = User.id'
        );

        if (!empty($year))
            $conditions['UsersKlass.year'] = $year;
        if (!empty($quarter))
            $conditions['UsersKlass.quarter'] = $quarter;

        $this->User->recursive = 0;
        return $this->User->find('all', array(
            'fields' => array('User.*', 'UsersKlass.year', 'UsersKlass.quarter'),
            'joins' => array(
                array(
                    'table' => 'users_klasses',
                    'alias' => 'UsersKlass',
                    'type' => 'INNER',
                    'conditions' => $conditions
                )
            )
        ));
    }

    /**
     * Get users associated with the class who were not enrolled in the given
     * academic year and quarter.
     *
     * @param $kid
     * @param $not_year Academic year
     * @param $not_quarter Quarter ID (see StanfordComponent constants, e.g.,
     *   CLASS_QUARTER_AUTUMN)
     */
    public function getUsersOtherRun($kid, $not_year, $not_quarter) {
        $this->User->recursive = 0;
        return $this->User->find('all', array(
            'fields' => array('User.*', 'UsersKlass.year', 'UsersKlass.quarter'),
            'joins' => array(
                array(
                    'table' => 'users_klasses',
                    'alias' => 'UsersKlass',
                    'type' => 'INNER',
                    'conditions' => array(
                        'UsersKlass.klass_id' => $kid,
                        'UsersKlass.user_id = User.id',
                        'OR' => array(
                            'AND' => array(
                                'UsersKlass.year' => $not_year,
                                'UsersKlass.quarter !=' => $not_quarter
                            ),

                            'UsersKlass.year !=' => $not_year
                        )
                    )
                )
            )
        ));
    }
}
