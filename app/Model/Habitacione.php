<?php
App::uses('AppModel','Model');
  class Habitacione extends AppModel {
    public $name = 'Habitacione';


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
            'nro_habitacion'    => array(
                    'notempty' => array(
                            'rule' => array('notEmpty'),
                            'message' => 'El num de habitación es requerido'
                    ),
                    'unique' => array(
                            'rule' => array('isUnique'),
                            'message' => 'El Num de habitación ya existe'
                    )
            )
    );
    
    
  public function listAllHabitaciones($order_by='Habitacione.created', $search_nro_habitacion='',$order='DESC') {
            $arr_obj_habitacione = $this->findObjects('all',array(
                    'conditions'=>array(
                                    'Habitacione.nro_habitacion LIKE'=> '%'.$search_nro_habitacion.'%',
                                    'Habitacione.estado != ' => 0
                    ),
                    'order'=> array($order_by.' '.$order)
            )
            );
        return $arr_obj_habitacione;
    }
    
    public function listFindHabitaciones($order_by='Habitacione.created', $order='DESC') {
            $arr_obj_habitacione = $this->findObjects('all',array(
                    'conditions'=>array(
                           // 'Habitacione.nro_habitacion LIKE'=> '%'.$search_nro_habitacion.'%',
                            'Habitacione.estado != ' => 0
                    ),
                    'order'=> array($order_by.' '.$order),
            )
            );
        return $arr_obj_habitacione;
    }
    
    /* Usado para el Combo del mantenimiento de trabajadores*/    
    public function listHabitaciones() {
        return $this->find('list',
                array(
                        'fields' => array('id','nro_habitacion'),
                        'conditions'=>array(
                                'Habitacione.estado != '=> 0
                        ),
                        'order' => array('Habitacione.id ASC')
                ));
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteHabitacione($habitacione_id){
    
        if($this->deleteAll(array('Habitacione.id' => $habitacione_id), $cascada = true)){
            return true;
        }else{
            return false;
        }
    }

    
  }
?>
