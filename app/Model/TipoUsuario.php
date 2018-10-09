<?php
App::uses('AppModel','Model');
  class TipoUsuario extends AppModel {
    public $name = 'TipoUsuario';

    public $hasMany = array(
    		'User' => array(
    				'className'    => 'User',
    				'foreignKey' => 'id',
    				'fields' => '',
    				'order' => ''
    				//'dependent'    => true
    		)
    );
    
    public function listAllTipoUsuarios() {
    	return $this->find('all');
    }
  }
?>
