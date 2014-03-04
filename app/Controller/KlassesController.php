<?php
App::uses('AppController', 'Controller');
/**
 * Klasses Controller
 *
 * @property Klass $Klass
 * @property PaginatorComponent $Paginator
 */
class KlassesController extends AppController {

    public $uses = array('Klass', 'User');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Klass->recursive = 0;
		$this->set('klasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Klass->exists($id)) {
			throw new NotFoundException(__('Invalid klass'));
		}

        $options = array('conditions' => array('Klass.' . $this->Klass->primaryKey => $id));
        $klass = $this->Klass->find('first', $options);

		$this->set('klass', $klass);
        $this->set('code_names', $this->Klass->getCodeNames($klass['KlassCode']));

        if ($this->Auth->loggedIn()) {
            $this->User->id = $this->Auth->user('id');
            $this->set('enrolled', $this->User->hasClass($id));
        }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Klass->create();
			if ($this->Klass->save($this->request->data)) {
				$this->Session->setFlash(__('The klass has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The klass could not be saved. Please, try again.'));
			}
		}
		$users = $this->Klass->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Klass->exists($id)) {
			throw new NotFoundException(__('Invalid klass'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Klass->save($this->request->data)) {
				$this->Session->setFlash(__('The klass has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The klass could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Klass.' . $this->Klass->primaryKey => $id));
			$this->request->data = $this->Klass->find('first', $options);
		}
		$users = $this->Klass->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Klass->id = $id;
		if (!$this->Klass->exists()) {
			throw new NotFoundException(__('Invalid klass'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Klass->delete()) {
			$this->Session->setFlash(__('The klass has been deleted.'));
		} else {
			$this->Session->setFlash(__('The klass could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * Add the current user to the given class
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function add_self($id = null) {
        $this->Klass->id = $id;
        if (!$this->Klass->exists())
            throw new NotFoundException(__('Invalid class'));

        $this->Klass->addUser($id, $this->Auth->user('id'));
        return $this->redirect(array('action' => 'view', $id));
    }

/**
 * Remove the current user from the given class
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function remove_self($id = null) {
        $this->Klass->id = $id;
        if (!$this->Klass->exists())
            throw new NotFoundException(__('Invalid class'));

        $this->Klass->removeUser($id, $this->Auth->user('id'));
        return $this->redirect(array('action' => 'view', $id));
    }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Klass->recursive = 0;
		$this->set('klasses', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Klass->exists($id)) {
			throw new NotFoundException(__('Invalid klass'));
		}
		$options = array('conditions' => array('Klass.' . $this->Klass->primaryKey => $id));
		$this->set('klass', $this->Klass->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Klass->create();
			if ($this->Klass->save($this->request->data)) {
				$this->Session->setFlash(__('The klass has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The klass could not be saved. Please, try again.'));
			}
		}
		$users = $this->Klass->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Klass->exists($id)) {
			throw new NotFoundException(__('Invalid klass'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Klass->save($this->request->data)) {
				$this->Session->setFlash(__('The klass has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The klass could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Klass.' . $this->Klass->primaryKey => $id));
			$this->request->data = $this->Klass->find('first', $options);
		}
		$users = $this->Klass->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Klass->id = $id;
		if (!$this->Klass->exists()) {
			throw new NotFoundException(__('Invalid klass'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Klass->delete()) {
			$this->Session->setFlash(__('The klass has been deleted.'));
		} else {
			$this->Session->setFlash(__('The klass could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
