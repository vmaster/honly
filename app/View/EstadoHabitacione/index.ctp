<script type="text/javascript">
$(document).ready(function(){

	$('#table_content_estado_habitaciones').DataTable({
	 	dom: 'T<"clear">lfrtip',
		tableTools: {
			"sSwfPath": env_webroot_script + "/lib/data.tables-1.10.6/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
	                "copy",
	                "csv",
	                "xls",
	                "pdf"
	                /*{
	                    "sExtends":    "collection",
	                    "aButtons":    [ "csv", "xls", "pdf" ]
	                }*/
	        ]
		}
	});
		
	$body = $('body');
	var order_by_select;
	var order_by_or;

});
</script>


<div class="content">
        
    <div class="header">
        <h1 class="page-title">Persona</h1>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">


	<div id="estado_habitacion">
	<div id="add_edit_estado_habitacion_container">
	</div>

	<div class="btn-toolbar">
	<button class="btn btn-primary btn-nuevo-estado-habitacion"><i class="icon-plus"></i> <?php echo __('Nueva Estado Habitación'); ?></button>
	<div class="btn-group">
	</div>
	</div>
	<p>
	<!-- 
	<div class="row">
	<div class="span3 col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
	<div class="span3 col-md-3 col-sm-6 col-xs-6">
		<label><?php echo __('Estado de Habitacione');?> <input type = "text" name ="txtBuscarNombre" id="txtBuscarNombre" class="form-control"></label>
	</div>
	</div>
	-->
	<div class="well">
	<div id = "conteiner_all_rows">
	<?php 
	if(empty($list_estado_habitacion)){ 
		echo __('No hay datos de Estados de Habitaciones');
	}else{ ?>  
	  <?php 
	  	echo $this->element('EstadoHabitacione/estado_habitacion_row');
		  ?>
	<?php }?>
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

	<div class="modal fade" id="myModalDeleteEstadoHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" estado_habitacione_id=''>
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
					<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar La Estado de Habitacion?')); ?>
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
				<button class="btn btn-danger eliminar-estado_habitacione-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
			</div>
		</div>
	</div>
	</div>

	</div>
</div>
</div>