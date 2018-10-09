        <tr  class= "usuario_row_container" usuario_id = "<?php echo $obj_usuario->getID(); ?>">
          <td>1</td>
          <td><?php echo $obj_usuario->getAttr('nombre_usuario'); ?></td>
          <td><?php echo $obj_usuario->TipoUsuario->getAttr('descripcion'); ?></td>
          <td><?php echo $obj_usuario->Persona->getAttr('nombre') ?></td>
          <td>
              <a><i class="icon-pencil add-edit-usuario-trigger"></i></a>
              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
          </td>
        </tr>
