<div class="container div-crear-habitacion form" id="div-crear-habitacion">
	<?php echo $this->Form->create('Habitacione',array('method'=>'post', 'id'=>'add_edit_habitacion'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreHabitacione'>".__('Número de Habitacione')."</label>"; ?>
				<?php echo $this->Form->input('nro_habitacion', array('div' => false, 'label' => false, 'class'=> 'txtNroHabitacion form-control','id' =>'txtNroHabitacionMant','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>

			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNivel'>".__('Nivel')."</label>"; ?>
				<select
					name="data[Habitacione][nivel]" class="cboNivel" id ="cbo-nivel">
					<?php 
						for($x= 1; $x<= 10; $x++ ){
						if(isset($obj_habitacion) || isset($habitacion_id)){
							if($x == $obj_habitacion->getAttr('nivel')){
								$selected = " selected = 'selected'";
							}else{
								$selected = "";
							}
						}else{
							$selected = "";
						}
						echo "<option value = ".$x.$selected.">".$x."</option>";
						}
					?>
				</select>
			</div>

			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php $list_tipo_habitacion =  Configure::read('LIST_TIPO_HABITACIONES'); ?>
				<?php echo "<label id='lblNombreHabitacione'>".__('Tipo Habitación')."</label>"; ?>
				<select
					name="data[Habitacione][tipo_habitacion_id]" class="cboTipoHabitacion" id ="cbo-tipo-habitacion">

					<?php foreach($list_tipo_habitacion as $descripcion => $id): 
						if(isset($obj_habitacion) || isset($habitacion_id)){
							if($id == $obj_habitacion->getAttr('tipo_habitacion_id')){
								$selected = " selected = 'selected'";
							}else{
								$selected = "";
							}
						}else{
							$selected = "";
						}
						echo "<option value = ".$id.$selected.">".$descripcion."</option>";
					?>

					<?php 
						endforeach;		
					?>

				</select>
			</div>

			<div class="check">
				<label> Aire acondicionado <input name="data[Habitacione][aire_acondicionado]" type="checkbox" value="0" id="rbtAireAcond" checked></label>
				<label> Terma <input name="data[Habitacione][terma]" type="checkbox" value="0" id="rbtTerma" checked></label>
				<label> Jacuzzi <input name="data[Habitacione][jacuzzi]" type="checkbox" value="0" id="rbtJacuzzi" checked></label>
				<label> Cable <input name="data[Habitacione][cable]" type="checkbox" value="0" id="rbtCable" checked></label>
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