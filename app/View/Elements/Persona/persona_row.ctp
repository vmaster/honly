<table id="example" class="display" style="width:100%">
	        <thead>
	            <tr>
		          <th><?php echo __('ID'); ?></th>
		          <th><?php echo __('Tipo Persona'); ?></th>
		          <th><?php echo utf8_encode(__('Nombre / Razón Social')); ?></th>
		          <th><?php echo utf8_encode(__('Correo electrónico')); ?></th>
		          <th><?php echo __('Nro. Documento'); ?></th>
		          <th><?php echo __('Sexo'); ?></th>
		          <th><?php echo utf8_encode(__('Móvil')); ?></th>
		          <th><?php echo __('Operaciones'); ?></th>
		        </tr>
	        </thead>
	        <tbody>
	            <?php 
					$n = 0;
					foreach ($list_persona as $persona):
					$n = $n + 1;
					?>

					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $persona->TipoPersona->getAttr('descripcion'); ?></td>
						<td><?php echo utf8_encode($persona->getAttr('nombre')).' '. utf8_encode($persona->getAttr('apellido')); ?></td>
						<td><?php echo $persona->getAttr('email'); ?></td>
						<td><?php echo $persona->getAttr('nro_documento'); ?></td>
						<td><?php echo $persona->getAttr('sexo'); ?></td>
						<td><?php echo $persona->getAttr('movil'); ?></td>
						<td><a><i class="icon-pencil edit-persona-trigger"></i> </a> 
							<a href="#myModalDeletePersona" role="button" data-toggle="modal"><i class="icon-remove open-model-delete-persona"></i> </a>
							<a href="#" class="link_roles">Roles</a>
						</td>
					</tr>
					<?php 
					endforeach;
					?>
	        </tbody>
</table>