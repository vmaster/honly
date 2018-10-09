<div id="usuario">
	<div id="add_edit_usuario_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-usuario add-edit-usuario-trigger"><i class="icon-plus"></i> <?php echo __('Nuevo Usuario'); ?></button>
	    <button class="btn">Import</button>
	    <button class="btn">Export</button>
	  <div class="btn-group">
	  </div>
	</div>
	<div class="well">
	    <table class="table" id = "table_usuarios">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th><?php echo __('Nombre de Usuario'); ?></th>
	          <th><?php echo __('Tipo de Usuario'); ?></th>
	          <th><?php echo __('Nombre'); ?></th>
	          <th style="width: 26px;"></th>
	        </tr>
	      </thead>
	      <tbody id = "conteiner_all_rows">
	      <?php foreach ($array_obj_usuario as $obj_usuario):
	      	echo $this->element('User/usuario_row',array('obj_usuario'=>$obj_usuario));
	 	  endforeach; ?>
	      </tbody>
	    </table>
	</div>
	<div class="pagination">
	    <ul>
	        <li><a href="#">Prev</a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li><a href="#">Next</a></li>
	    </ul>
	</div>
	
	<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        <h3 id="myModalLabel">Delete Confirmation</h3>
	    </div>
	    <div class="modal-body">
	        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
	    </div>
	    <div class="modal-footer">
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
	    </div>
	</div>
</div>