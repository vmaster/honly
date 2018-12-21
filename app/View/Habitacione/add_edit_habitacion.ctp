<div class="container div-crear-habitacion form" id="div-crear-habitacion">
	<?php echo $this->Form->create('Habitacione',array('method'=>'post', 'id'=>'add_edit_habitacion'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreHabitacione'>".__('Nombre de Habitacione')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtNombreHabitacione form-control','id' =>'txtHabitacioneMant','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
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