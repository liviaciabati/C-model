<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	
	public $uses = array('User');

	public $paginate = array(
		'limit'=>10,
		'recursive'=>2
		);
		

	public function index() {
		$this->set('users', $this->paginate());
	}

	
	public function login() {
	
	    if ($this->Auth->login()) {
	        $this->Session->setFlash(__('Usuário logado com sucesso'),'flash_success');
	        $this->redirect($this->Auth->redirect());
	    } else {
	        $this->Session->setFlash(__('Senha ou nome de usuário inválidos. Tente novamente.'),'flash_error');
	        $this->redirect(array('controller'=>'pages','action'=>'display','login'));
	    }
	}

	public function logout() {
		$this->Session->setFlash(__('Usuário deslogado com sucesso'),'flash_success');
	    $this->redirect($this->Auth->logout());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'),'flash_success');
				return $this->redirect(array('url' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'flash_error');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'),'flash_success');
				return $this->redirect(array('url' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'flash_error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'),'flash_success');
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'),'flash_error');
		}
		return $this->redirect(array('url' => 'index'));
	}}
