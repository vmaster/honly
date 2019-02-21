<table class="table" id="table_content_habitaciones">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo utf8_encode(__('Num Habitaci&oacute;n')); ?></th>
          <th><?php echo utf8_encode(__('Tipo Habitaci&oacute;n')); ?></th>
          <th><?php echo utf8_encode(__('Estado Habitaci&oacute;n')); ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_habitacion as $habitacion):
		$n = $n + 1;
		?>
		<tr class="habitacion_row_container" habitacion_id="<?php echo $habitacion->getAttr('id'); ?>">
			<td><?php echo $n; ?></td>
			<td><?php echo $habitacion->getAttr('nro_habitacion'); ?></td>
			<td><?php echo $habitacion->getAttr('tipo_habitacion_id'); ?></td>
			<td><?php echo $habitacion->getAttr('estado_habitacion_id'); ?></td>
			<td><a><i class="icon-pencil edit-habitacion-trigger"></i> </a> 
				<a href="#myModalDeleteHabitacion" role="button" data-toggle="modal"><i class="icon-remove open-model-delete-habitacion"></i> </a>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>