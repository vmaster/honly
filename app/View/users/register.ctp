<div class="form-crear-usuario form">
    <?php echo $this->Form->create('User',array('method'=>'post'));?>
    <fieldset>
        <legend>Crear Usuario</legend>
        <label>Elija un empleado</label>
		<!-- <select name="data[PersonaNaturale][id]">
			<?php 
			/*if (isset($list_all_personals)){
				foreach ($list_all_personals as $list_all_personal):
				echo "<option value = ".$list_all_personal->PersonaNaturale->getAttr('id').">".$list_all_personal->PersonaNaturale->getAttr('nombre')." ".$list_all_personal->PersonaNaturale->getAttr('apellido')."</option>";
				endforeach;
			}*/
			?>
		</select> -->
		<?php
            echo $this->Form->input(__('username'));
            echo $this->Form->input(__('password'), array('type' => 'password'));
        	echo "<label>".__('Tipo de Usuario')."</label>";
        ?>
        <select name = "[User][tipo_usuarios_id]">
        <?php 
        if (isset($list_all_tipo_usuarios)){
            	foreach ($list_all_tipo_usuarios as $k => $v) {
            	echo "<option value = ".$v['TipoUsuario']['id'].">".$v['TipoUsuario']['descripcion']."</option>";
            	}
        }
        ?>
        </select>
        
    </fieldset>
    <button type="submit" class="btn trigger_crear_usuariox">Crear</button>
    <?php
        //echo $this->Form->end(__('Crear'));
    ?>
    <button class="btn btn-cancelar-crear-usuario"><?php echo __('Cancelar');?></button>
</div>