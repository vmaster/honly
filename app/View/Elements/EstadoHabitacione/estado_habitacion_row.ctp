<table class="table" id="table_content_estado_habitaciones">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo utf8_encode(__('Descripci&oacute;n')); ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_estado_habitacion as $estado_habitacion):
		$n = $n + 1;
		?>
		<tr class="estado_habitacion_row_container" estado_habitacion_id="<?php echo $estado_habitacion->getAttr('id'); ?>">
			<td><?php echo $n; ?></td>
			<td><?php echo $estado_habitacion->getAttr('descripcion'); ?></td>
			<td><a><i class="icon-pencil edit-estado-habitacion-trigger"></i> </a> 
				<a href="#myModalDeleteEstadoHabitacion" role="button" data-toggle="modal"><i class="icon-remove open-model-delete-estado-habitacion"></i> </a>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>