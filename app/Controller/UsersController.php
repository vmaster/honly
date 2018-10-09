<?php
//App::uses('AppController', 'Controller');
class UsersController extends AppController{

	//var $components = array('Auth', 'Session');
	public $name = 'Users';

	public function beforeFilter(){
		$this->Auth->allow(array('login','register','logout'));
		//parent::beforeFilter();
	}

	public function login() {
		$this->layout = "default_external";

		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->User->saveField('ultimo_acceso', date('Y-m-d H:i:s') );
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Nombre de usuario or Clave is incorrect'),array(),'auth');
			}
		}else{
			if($this->Auth->user('id')){
				$this->redirect($this->Auth->redirect());
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}


	/*public function view($id = null) {
	 $this->Usuario->id = $id;
	if (!$this->Usuario->exists()) {
	throw new NotFoundException(__('Invalid usuario'));
	}
	$this->set('usuario', $this->Usuario->read(null, $id));
	}*/
	public function index() {
		$this->layout = "default";
		$this->loadModel('TipoUsuario');
		$this->loadModel('Persona');
		$array_obj_usuario = $this->User->listarInfoPersonalUsuario();
		$this->set(compact('array_obj_usuario'));
	}

	/**
	 * Add and Edit using Ajax
	 * 20 March 2013
	 * @author Vladimir
	 */
	public function add_edit_usuario($usuario_id=null){
		$this->layout = 'ajax';
		$this->loadModel('TipoUsuario');
		$this->loadModel('Persona');
		$list_all_personals = $this->Persona->listAllPersonal();
		$list_all_tipo_usuarios = $this->TipoUsuario->listAllTipoUsuarios();
		$this->set(compact('list_all_tipo_usuarios','list_all_personals'));

		if($this->request->is('post')  || $this->request->is('put')){
			 
			if(isset($usuario_id) && intval($usuario_id) > 0){
				//update
				$this->Usuario->id = $usuario_id;

				$this->Usuario->set($this->request->data);
				$this->Usuario->setFields();

				if ($this->Usuario->save()) {
					echo json_encode(array('success'=>true,'msg'=>__('Usuario updated.'),'Usuario_id'=>$usuario_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Your information is incorrect.'),'validation'=>$this->Usuario->validationErrors));
					exit();
				}
			}else{
				//insert
				$this->request->data['Usuario']['id'] = $this->request->data['PersonaNaturale']['id'];

				$this->Usuario->set($this->request->data);
				$this->Usuario->setFields();

				//$this->Usuario->create();
				if ($this->Usuario->save()) {
					$usuario_id = $this->Usuario->id;
					echo json_encode(array('success'=>true,'msg'=>__('Usuario added.'),'Usuario_id'=>$usuario_id));
					exit();
				}else{
					$usuario_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Your information is incorrect.'),'validation'=>$this->Usuario->validationErrors));
					exit();
				}
			}
		}else{

		}

	}

	public function get_usuario_row($usuario_id){
		$this->layout = 'ajax';

		$this->loadModel('Usuario');
		$obj_usuario = $this->Usuario->findById($usuario_id);
		$this->set(compact('usuario_id','obj_usuario'));
	}

	public function register(){
		$this->layout = "default";
		$this->loadModel('TipoUsuario');
		$list_all_tipo_usuarios = $this->TipoUsuario->listAllTipoUsuarios();
		$this->set(compact('list_all_tipo_usuarios'));
		if($this->request->is('post')){
			//$hashedPasswords = $this->Usuario->hashPasswords($this->request->data);
			//$this->request->data['Usuario']['clave'] = $hashedPasswords['Usuario']['clave'];
			//$this->request->data['Usuario']['clave'] = $this->Auth->password($this->request->data['Usuario']['clave']);
			$this->User->create();
			if($this->User->save($this->request->data)){
				$this->Session->setFlash(__('El Usuario fue creado con éxito'));
				$this->redirect(array('action' => 'index'), null, true);
				//return $this->redirect(array('action'=>'index'));
			}
		}
	}
}
?>
