<div class="container div-crear-estado-habitacion form" id="div-crear-estado-habitacion">
	<?php echo $this->Form->create('EstadoHabitacione',array('method'=>'post', 'id'=>'add_edit_estado-habitacion'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreEstadoHabitacione'>".__('Nombre de EstadoHabitacione')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtNombreEstadoHabitacione form-control','id' =>'txtEstadoHabitacioneMant','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_estado_habitacion_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-estado-habitacion"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>