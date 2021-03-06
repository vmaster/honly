<div class="container div-crear-user form" id="div-crear-user">
	<?php echo $this->Form->create('User',array('method'=>'post', 'id'=>'add_edit_user'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6" id="div-cbo-trabajadores">
				<label><?php echo __('Elija un empleado'); ?> </label>
				<select name="data[Trabajadore][id]" class='form-control' id="cboTrabajadores">
					<?php 
					if (isset($list_all_personals)){
						foreach ($list_all_personals as $list_all_personal):
						echo "<option value = ".$list_all_personal->getAttr('id').">".$list_all_personal->getAttr('apellido_nombre')."</option>";
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo utf8_encode(__('Nombre de usuario')); ?> </label>
				<?php echo $this->Form->input('username', array('div' => false, 'label' => false, 'class'=>'form-control')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo utf8_encode(__('Contraseņa')); ?> </label>
				<?php echo $this->Form->input('password', array('type' =>'password', 'div' => false, 'label' => false, 'class'=>'form-control')); ?>
				<input type=password id="txtPasswordFalse" class="form-control" value="&j546d5fn456s7dfg8nng" style="display:none" disabled>
				<a href="#myModalChangePass" class='link_cambiar_clave' data-toggle="modal"><?php echo utf8_encode(__('Cambiar contraseņa')); ?></a>
			</div>
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Tipo de Usuario'); ?> </label>
				<select name = "data[User][tipo_user_id]" class='form-control'>
			        <?php 
			        if (isset($list_all_tipo_usuarios)){
			            	foreach ($list_all_tipo_usuarios as $k => $v) {
								if(isset($obj_user) || isset($user_id)){
									if($v['TipoUsuario']['id'] == $obj_user->getAttr('tipo_user_id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
								}else{
									$selected = "";
								}
			            		echo "<option value = ".$v['TipoUsuario']['id'].$selected.">".$v['TipoUsuario']['descripcion']."</option>";
			            	}
			        }
			        ?>
		        </select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Estado'); ?> </label>
				<select name = "data[User][estado]" class='form-control'>
			        <?php 
							if (isset($obj_user)){
								echo "<option value = ".$obj_user->getAttr('estado')." selected='selected'>";
								if($obj_user->getAttr('estado') == 1){ 
									echo __('ACTIVO')."</option>";
									echo "<option value = 0>".__('INACTIVO')."</option>";
								}else{ 
									echo __('INACTIVO')."</option>";
									echo "<option value = 1>".__('ACTIVO')."</option>";
								}
							}else{
							?>
							<option value= 1>
								<?php echo __('ACTIVO'); ?>
							</option>
							<option value= 0>
								<?php echo __('INACTIVO'); ?>
							</option>
					<?php }  ?>
		        </select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Consorcio'); ?> </label>
				<select name = "data[User][consorcio_id]" class='cboConsorcio form-control'>
					<option selected="selected">
						--
						<?php echo utf8_encode(__('Seleccione Consorcio')); ?>
						--
					</option>
			        <?php 
				        if (isset($list_consorcios)){
				            	foreach ($list_consorcios as $consorcio) {
									if(isset($obj_user) || isset($user_id)){
										if($consorcio->getAttr('id') == $obj_user->getAttr('consorcio_id')){
											$selected = " selected = 'selected'";
										}else{
											$selected = "";
										}
									}else{
										$selected = "";
									}
				            		echo "<option value = ".$consorcio->getAttr('id').$selected.">".$consorcio->getAttr('descripcion')."</option>";
				            	}
				        }
			        ?>
		        </select>
			</div>	
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Unidad de negocio'); ?> </label>
				<select disabled name = "data[User][uunn_id]" class='cboUunn form-control'>
					<option selected="selected">
						--
						<?php echo utf8_encode(__('Seleccione Unidad de Negocio')); ?>
						--
					</option>
			        <?php 
				        if (isset($list_all_uunn)){
				            	foreach ($list_all_uunn as $uunn) {
									if(isset($obj_user) || isset($user_id)){
										if($uunn->getAttr('id') == $obj_user->getAttr('uunn_id')){
											$selected = " selected = 'selected'";
										}else{
											$selected = "";
										}
									}else{
										$selected = "";
									}
				            		echo "<option value = ".$uunn->getAttr('id').$selected.">".$uunn->getAttr('descripcion')."</option>";
				            	}
				        }
			        ?>
		        </select>
			</div>
		<br>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_user_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-user"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
</div>
<hr>
<div class="modal fade" id="myModalChangePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" user_id= '<?php echo (isset($user_id))?$user_id:''; ?>'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Cambiar contraseņa')); ?></h3>
				</div>
				<?php echo $this->Form->create('UserChangePass',array('method'=>'post', 'id'=>'form_change_pass','action'=> false));?>
				<div class="modal-body">
							<p>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Nueva Contraseņa')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('new_password', array('type' =>'password', 'div' => false, 'label' => false, 'class'=>'form-control','id'=>'new-password')); ?>
								</div>
							</div>
							<p>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Confirmar nueva Contraseņa')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('new_password_confirm', array('type' =>'password', 'div' => false, 'label' => false, 'class'=>'form-control','id'=>'confirm-password')); ?>
								</div>
							</div>
						
				</div>
				<?php echo $this->Form->end(); ?>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger change-pass-user-trigger"><?php echo __('Aceptar'); ?></button>
				</div>
				
			</div>
		</div>
	</div>