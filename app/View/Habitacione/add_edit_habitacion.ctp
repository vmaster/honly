<div class="container div-crear-habitacion form" id="div-crear-habitacion">
	<?php echo $this->Form->create('Habitacione',array('method'=>'post', 'id'=>'add_edit_habitacion'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNumHabitacione'>".__('Número de Habitación')."</label>"; ?>
				<?php echo $this->Form->input('nro_habitacion', array('div' => false, 'label' => false, 'class'=> 'txtNroHabitacion form-control','id' =>'txtNroHabitacion','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label  id='lblHabitacion'>".__('Habitación')."</label>"; ?>
				<select name="data[Habitacione][nivel]" class="cboHabitacion form-control" id = "cboHabitacion">
					<?php
						if (isset($obj_habitacion)){
							echo "<option value = ".$obj_persona->getAttr('sexo')." selected='selected'>";
							if($obj_persona->getAttr('sexo') == 'M'){ 
								echo __('Masculino')."</option>";
								echo "<option value = 'F'>".__('Femenino')."</option>";
							}else{ 
								echo __('Femenino')."</option>";
								echo "<option value = 'M'>".__('Masculino')."</option>";
							}
						}else{
						?>
						<option value="M">
							<?php echo __('Masculino'); ?>
						</option>
						<option value="F">
							<?php echo __('Femenino'); ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblTipoHabitacion'>".__('Tipo Habitación')."</label>"; ?>
				<?php echo $this->Form->input('nivel', array('div' => false, 'label' => false, 'class'=> 'txtNivel form-control','id' =>'txtNivel','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_habitacion_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-habitacion"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>