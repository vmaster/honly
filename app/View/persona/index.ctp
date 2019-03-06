<script type="text/javascript">
$(document).ready(function(){

	 $('#table_content_personas').DataTable({
    	//'ajax': env_webroot_script + 'personas/ajax_list_personas'
    	ajax: {
    		url: env_webroot_script + 'personas/ajax_list_personas',
    		dataSrc: 'data'
    		//"dataSrc": "tableData"
    	}
    });

});
</script>


<div class="content">
        
    <div class="header">
        <h1 class="page-title">Persona</h1>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">


	<div id="persona">
		<div id="add_edit_persona_container">
		</div>

		<div class="btn-toolbar">
		<button class="btn btn-primary btn-nuevo-persona"><i class="icon-plus"></i> <?php echo __('Nueva Persona'); ?></button>
		<div class="btn-group">
		</div>
	</div>
	<p>

	<div class="well">
		<div id = "conteiner_all_rows">
			<?php 
				  	echo $this->element('Persona/persona_row');
					  ?>
			<?php 
			//debug($list_persona);
			/*
				if(empty($list_persona)){ 
					echo __('No hay datos de Personaes');
				}else{ ?>  
				  <?php 
				  	echo $this->element('Persona/persona_row');
					  ?>
			<?php }*/?>
		</div>		
	</div>
	<!-- <div class="pagination">
	<ul>
	    <li><a href="#">Prev</a></li>
	    <li><a href="#">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">Next</a></li>
	</ul>
	</div>
	-->

		<div class="modal fade" id="myModalDeletePersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" persona_id=''>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true"><i class="fa fa-times"></i></button>
						<h3 id="myModalLabel"><?php echo utf8_encode(__('Confirmar Eliminación')); ?></h3>
					</div>
					<div class="modal-body">
						<p class="error-text">
							<i class="icon-warning-sign modal-icon"></i>
							<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar La Persona?')); ?>
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
						<button class="btn btn-danger delete-persona-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
</div>