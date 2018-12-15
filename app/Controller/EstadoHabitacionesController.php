<?php
class EstadoHabitacionesController extends AppController{
	public $name = 'EstadoHabitacione';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
        
		$this->layout = "default";
		$this->loadModel('EstadoHabitacione');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		
		/*if($order_by=='title'){
			$order_by = 'Bit.title';
		}elseif($order_by=='username'){
			$order_by = 'UserJoin.username';
		}elseif($order_by=='home'){
			$order_by = 'Bit.view_home';
		}elseif($order_by=='status'){
			$order_by = 'Bit.status';
		}else{
			$order_by = 'Bit.created';
		}*/
		$order_by = 'EstadoHabitacione.created';
		
		if($this->request->is('get')){
			if($search_descripcion!=''){
				$search_descripcion = $search_descripcion;
			}else{
				$search_descripcion = '';
			}

		}else{
			$search_descripcion = '';
		}
		
		$list_estado_habitacion_all = $this->EstadoHabitacione->listAllEstadoHabitaciones($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_estado_habitacion = $this->EstadoHabitacione->listFindEstadoHabitaciones($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_estado_habitacion_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_estado_habitacion','page','no_of_paginations'));
	}
	
	public function find_estado_habitaciones() {
		$this->layout = 'ajax';
		$this->loadModel('EstadoHabitacione');

		$order_by='EstadoHabitacione.created';
		$order = 'DESC';
	
		$list_estado_habitacion = $this->EstadoHabitacione->listFindEstadoHabitaciones($order_by, $order);
		
		$this->set(compact('list_estado_habitacion'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_estado_habitacion($estado_habitacion_id=null){
		$this->layout = 'ajax';
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($estado_habitacion_id) && intval($estado_habitacion_id) > 0){
				
				//update
				$error_validation = '';
				
				$this->EstadoHabitacione->id = $estado_habitacion_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->EstadoHabitacione->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->EstadoHabitacione->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';

				$this->request->data['EstadoHabitacione']['estado']= 1;
				
				$this->EstadoHabitacione->create();
				if ($this->EstadoHabitacione->save($this->request->data)) {
					$estado_habitacion_id = $this->EstadoHabitacione->id;
					echo json_encode(array('success'=>true,'msg'=>__('La estado_habitacion fue agregado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
					exit();
				}else{
					$estado_habitacion_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->EstadoHabitacione->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($estado_habitacion_id)){
				$obj_estado_habitacion = $this->EstadoHabitacione->findById($estado_habitacion_id);
				
				$this->request->data = $obj_estado_habitacion->data;
				$this->set(compact('estado_habitacion_id','obj_estado_habitacion'));
			}
		}
	}
	
	public function delete_estado_habitacion(){
		$this->layout = 'ajax';
	
		$this->loadModel('EstadoHabitacione');
	
		if($this->request->is('post')){
			$estado_habitacion_id = $this->request->data['estado_habitacion_id'];
			
			$obj_estado_habitacion = $this->EstadoHabitacione->findById($estado_habitacion_id);
			if($obj_estado_habitacion->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->EstadoHabitacione->deleteEstadoHabitacione($estado_habitacion_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	}
	
	public function add_estado_habitacion(){
		$this->layout = 'ajax';
		$this->loadModel('EstadoHabitacione');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['EstadoHabitacione']['descripcion']); exit();
			$this->EstadoHabitacione->create();
			if ($this->EstadoHabitacione->save($this->request->data)) {
				$estado_habitacion_id = $this->EstadoHabitacione->id;
				echo json_encode(array('success'=>true,'msg'=>__('La estado_habitacion fue agregado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
				exit();
			}else{
				$estado_habitacion_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->EstadoHabitacione->validationErrors));
				exit();
			}	
		}
	}
	
}