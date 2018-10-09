<?php
App::uses('AppModel','Model');
  class User extends AppModel {
    public $name = 'User';
    //public $displayField = 'nombre_usuario';
    
    //public $virtualFields = array('captcha' => 0);
    
    function beforeFilter() {
    	/*$this->Auth->authenticate = ClassRegistry::init('User');*/
    	parent::beforeFilter();
    }
    
    public $belongsTo = array(
    		'TipoUsuario' => array(
    				'className' => 'TipoUsuario',
    				'foreignKey' => 'tipo_usuario_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    public $hasOne = array(
    		'Persona' => array(
    				'className'    => 'Persona',
    				'foreignKey' => 'id',
    				'fields' => '',
    				'order' => ''
    				//'dependent'    => true
    		)
    );

    public $validate = array(
        'username'    => array(
            'required' => array(
                'rule' => array('notEmpty','isUnique'),
                'message' => 'Nombre de usuario es requerido'
            )
        ),
        'password'     => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La clave es requerida'
            )
        )
    );
    
    public function beforeSave($options = array()) {
    
    	/* password hashing */
    	if (isset($this->data[$this->alias]['password'])) {
    		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    	}
    	return true;
    }
    
    public function listarInfoPersonalUsuario(){
    	$arr_obj_info_usuarios = $this->findObjects('all',array(
    			'joins' => array(
    					array(
    							'table' => 'tipo_usuarios',
    							'alias' => 'TipoUsuarioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TipoUsuarioJoin.id = User.tipo_usuario_id'
    							)
    					)
    					),
    			'order'=> array('User.created ASC'),
    	)
    	);
    	return $arr_obj_info_usuarios;
    }
    
    public function hashPasswords($data) {
    	if (isset($data['User']['clave'])) {
    		$data['User']['clave'] = md5($data['User']['clave']);
    		return $data;
    	}
    	return $data;
    }


    public function deleteUser($user_id){
        if($this->deleteAll(array('User.id' => $user_id), $cascada = false)){
            return true;
        }else{
            return false;
        }
    }

    
    public function checkPasswordForUser($user_id, $current_pass = null){
        $obj_user = $this->findById($user_id);

        $old_pass = $obj_user ->getAttr('password');
        $current_pass_hash = AuthComponent::password($current_pass);

    
        if($current_pass_hash == $old_pass){
            return true;
        }
        return false;
    }
    

  }
?>
