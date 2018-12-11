<script type="text/javascript">
$body = $('body');
var order_by_select;
var order_by_or;

$body.off('click','div#persona .edit-persona-trigger');
	$body.on('click','div#persona .edit-persona-trigger', function(){
		persona_id = $(this).parents('.persona_row_container').attr('persona_id');
		//alert(persona_id); return false;
		//tipo_persona_id = $(this).parents('.persona_row_container').attr('tipo_persona_id');
		persona.openAddEditPersona(persona_id);
	});

$(document).ready( function () {
    $('#t_persona').DataTable({

    	//'ajax': env_webroot_script + 'personas/ajax_list_personas'

    	ajax: {
    		url: env_webroot_script + 'personas/ajax_list_personas',
    		dataSrc: 'data'
    		//"dataSrc": "tableData"
    	}


    });
} );

</script>
<div id="persona">
	<div id="add_edit_persona_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-persona"><i class="icon-plus"></i> <?php echo __('Nuevo Persona'); ?></button>
		  <div class="btn-group">
		  </div>
	</div>
	<div class="well">
	    <?php 
		if(empty($list_persona)){ 
			echo __('No hay datos de personas');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('Persona/persona_row');
	 	  ?>
	      </div>
	    <?php }?>
	</div>

	<div class="modal small hide fade" id="myModalDeletePersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" persona_id="">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        <h3 id="myModalLabel">Delete Confirmation</h3>
	    </div>
	    <div class="modal-body">
	        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
	    </div>
	    <div class="modal-footer">
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	        <button class="btn btn-danger delete-persona-trigger" data-dismiss="modal">Delete</button>
	    </div>
	</div>
</div>