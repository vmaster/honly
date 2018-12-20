<?php
class HabitacionesController extends AppController{
	public $name = 'Habitacione';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_num_habitacion=null) {
        
		$this->layout = "default";
		$this->loadModel('Habitacione');
		
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
		$order_by = 'Habitacione.created';
		
		if($this->request->is('get')){
			if($search_num_habitacion!=''){
				$search_num_habitacion = $search_num_habitacion;
			}else{
				$search_num_habitacion = '';
			}

		}else{
			$search_num_habitacion = '';
		}
		
		$list_estado_habitacion_all = $this->Habitacione->listAllHabitaciones($order_by, utf8_encode($search_num_habitacion),$order_by_or);
		$list_estado_habitacion = $this->Habitacione->listFindHabitaciones($order_by, utf8_encode($search_num_habitacion),$order_by_or, $start, $per_page);
		$count = count($list_estado_habitacion_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_estado_habitacion','page','no_of_paginations'));
	}
	
	public function find_habitaciones() {
		$this->layout = 'ajax';
		$this->loadModel('Habitacione');

		$order_by='Habitacione.created';
		$order = 'DESC';
	
		$list_estado_habitacion = $this->Habitacione->listFindHabitaciones($order_by, $order);
		
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
				
				$this->Habitacione->id = $estado_habitacion_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->Habitacione->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Habitacione->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';

				$this->request->data['Habitacione']['estado']= 1;
				
				$this->Habitacione->create();
				if ($this->Habitacione->save($this->request->data)) {
					$estado_habitacion_id = $this->Habitacione->id;
					echo json_encode(array('success'=>true,'msg'=>__('La estado_habitacion fue agregado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
					exit();
				}else{
					$estado_habitacion_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Habitacione->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($estado_habitacion_id)){
				$obj_estado_habitacion = $this->Habitacione->findById($estado_habitacion_id);
				
				$this->request->data = $obj_estado_habitacion->data;
				$this->set(compact('estado_habitacion_id','obj_estado_habitacion'));
			}
		}
	}
	
	public function delete_estado_habitacion(){
		$this->layout = 'ajax';
	
		$this->loadModel('Habitacione');
	
		if($this->request->is('post')){
			$estado_habitacion_id = $this->request->data['estado_habitacion_id'];
			
			$obj_estado_habitacion = $this->Habitacione->findById($estado_habitacion_id);
			if($obj_estado_habitacion->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Habitacione->deleteEstadoHabitacione($estado_habitacion_id)){
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
		$this->loadModel('Habitacione');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['Habitacione']['num_habitacion']); exit();
			$this->Habitacione->create();
			if ($this->Habitacione->save($this->request->data)) {
				$estado_habitacion_id = $this->Habitacione->id;
				echo json_encode(array('success'=>true,'msg'=>__('La estado_habitacion fue agregado con &eacute;xito.'),'EstadoHabitacione_id'=>$estado_habitacion_id));
				exit();
			}else{
				$estado_habitacion_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Habitacione->validationErrors));
				exit();
			}	
		}
	}
	
}