<div class="form-crear-usuario form">
    <?php echo $this->Form->create('Usuario',array('method'=>'post'));?>
    <fieldset>
        <legend>Crear Usuario</legend>
        <label>Elija un empleado</label>
		<select name="data[Persona][id]">
			<?php 
			if (isset($list_all_personals)){
				foreach ($list_all_personals as $list_all_personal):
				echo "<option value = ".$list_all_personal->getAttr('id').">".$list_all_personal->getAttr('nombre')." ".$list_all_personal->getAttr('apellido')."</option>";
				endforeach;
			}
			?>
		</select>
		<?php
            echo $this->Form->input(__('nombre_usuario'));
            echo $this->Form->input(__('clave'), array('type' => 'password'));
        	echo "<label>".__('Tipo de Usuario')."</label>";
        ?>
        <select name = "[Usuario][tipo_usuarios_id]">
        <?php 
        if (isset($list_all_tipo_usuarios)){
            	foreach ($list_all_tipo_usuarios as $k => $v) {
            	echo "<option value = ".$v['TipoUsuario']['id'].">".$v['TipoUsuario']['descripcion']."</option>";
            	}
        }
        ?>
        </select>
        
    </fieldset>
    <button type="button" class="btn trigger_crear_usuario">Crear</button>
    <?php
        //echo $this->Form->end(__('Crear'));
    ?>
    <button class="btn btn-cancelar-crear-usuario"><?php echo __('Cancelar');?></button>
</div>