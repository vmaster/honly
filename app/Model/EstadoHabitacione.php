<?php
App::uses('AppModel','Model');
  class Empresa extends AppModel {
    public $name = 'EstadoHabitacione';


    public $hasMany = array(
    		'Habitacione' => array(
    				'className' => 'Habitacione',
    				'foreignKey' => 'estado_habitacion_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		)
    );
    
    public $validate = array(
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La descripcion es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'El estado ya existe'
    				)
    		)
    );
    
    
  public function listAllEstadoHabitaciones($order_by='EstadoHabitacione.created', $search_descripcion='',$order='DESC') {
            $arr_obj_estado_habitacione = $this->findObjects('all',array(
                    'conditions'=>array(
                                    'EstadoHabitacione.descripcion LIKE'=> '%'.$search_descripcion.'%',
                                    'EstadoHabitacione.estado != ' => 0
                    ),
                    'order'=> array($order_by.' '.$order)
            )
            );
        return $arr_obj_estado_habitacione;
    }
    
    public function listFindEstadoHabitaciones($order_by='Trabajadore.created', $search_descripcion='',$order='DESC', $start=0, $per_page=10) {
            $arr_obj_estado_habitacione = $this->findObjects('all',array(
                    'conditions'=>array(
                            'EstadoHabitacione.descripcion LIKE'=> '%'.$search_descripcion.'%',
                            'EstadoHabitacione.estado != ' => 0
                    ),
                    //'page'=> $start,
                    'limit'=> $per_page,
                    'offset'=> $start,
                    'order'=> array($order_by.' '.$order),
            )
            );
        return $arr_obj_estado_habitacione;
    }
    
    /* Usado para el Combo del mantenimiento de trabajadores*/    
    public function listEstadoHabitaciones() {
        return $this->find('list',
                array(
                        'fields' => array('id','descripcion'),
                        'conditions'=>array(
                                'EstadoHabitacione.estado != '=> 0
                        ),
                        'order' => array('EstadoHabitacione.id ASC')
                ));
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteEstadoHabitacione($estado_habitacione_id){
    
        if($this->deleteAll(array('EstadoHabitacione.id' => $estado_habitacione_id), $cascada = true)){
            return true;
        }else{
            return false;
        }
    }

    
  }
?>
