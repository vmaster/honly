
$(document).ready(function(){
	
	EstadoHabitacion = this;
	$body = $('body');
	
	estado_habitacion = {
		openAddEditEstadoHabitacion: function(estado_habitacion_id){
			if(estado_habitacion_id == undefined || !estado_habitacion_id) {
				estado_habitacion_id ='';
			}
			
			$('div#estado_habitacion #add_edit_estado_habitacion_container').unbind();
			$('div#estado_habitacion #add_edit_estado_habitacion_container').load(env_webroot_script + 'estado_habitaciones/add_edit_estado_habitacion/'+estado_habitacion_id,function(){
				//alert();
			});
		},
		
		deleteEstadoHabitacione: function(estado_habitacion_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'estado_habitaciones/delete_estado_habitacion',
				data:{
					'estado_habitacion_id': estado_habitacion_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.estado_habitacion_row_container[estado_habitacion_id='+estado_habitacion_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveEstadoHabitacioneMantenimiento: function(){
			$form = $('.btn_crear_estado_habitacion_trigger').parents('form').eq(0);
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_estado_habitacion_container').hide();
					$('#conteiner_all_rows').load(env_webroot_script + escape('estado_habitaciones/find_estado_habitaciones/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#table_content_estado_habitaciones').DataTable();
					});
					alertify.success(data.msg);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[EstadoHabitacione]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[EstadoHabitacione]['+key+']"]').change(function() {
							$('[name="data[EstadoHabitacione]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		},
		
		saveEstadoHabitacioneModal: function(){
			$form = $('form#form_create_estado_habitacion').eq(0);
			$.ajax({
				url: env_webroot_script + 'estado_habitaciones/add_estado_habitacion',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddEstadoHabitacione').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_estado_habitacion = $('#txt-nombre-estado-habitacion').val();
					$('#txt-nombre-estado-habitacion').val('');
					new_option = "<option value='" + data.EstadoHabitacione_id + "'>"+txt_estado_habitacion+"</option>";
					$('.cbo-estado-habitacions-select2 option:last').after(new_option);
					$(".cbo-estado-habitacions-select2").select2("val", [data.EstadoHabitacione_id ,txt_estado_habitacion]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[EstadoHabitacione]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[EstadoHabitacione]['+key+']"]').change(function() {
							$('[name="data[EstadoHabitacione]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear EstadoHabitacione */
	$body.off('click','div#estado_habitacion .btn-nuevo-estado-habitacion');
	$body.on('click', 'div#estado_habitacion .btn-nuevo-estado-habitacion' , function(){
		estado_habitacion_id = $(this).attr('estado_habitacion_id');
		estado_habitacion.openAddEditEstadoHabitacion(estado_habitacion_id);
	});
	
	/* Ocultar formulario Crear EstadoHabitacione*/
	$body.on('click','div#div-crear-estado-habitacion .btn-cancelar-crear-estado-habitacion', function(){
		$('#add_edit_estado_habitacion').hide();
	});
	
	$body.off('click','.btn_crear_estado_habitacion_trigger');
	$body.on('click','.btn_crear_estado_habitacion_trigger',function(){
		estado_habitacion.saveEstadoHabitacioneMantenimiento();
	});


	$body.off('click','div#estado_habitacion .edit-estado-habitacion-trigger');
	$body.on('click','div#estado_habitacion .edit-estado-habitacion-trigger', function(){
		estado_habitacion_id = $(this).parents('.estado_habitacion_row_container').attr('estado_habitacion_id');
		estado_habitacion.openAddEditEstadoHabitacion(estado_habitacion_id);
	});
	
	$body.off('click','div#estado_habitacion .open-model-delete-estado-habitacion');
	$body.on('click','div#estado_habitacion .open-model-delete-estado-habitacion', function(){
		estado_habitacion_id = $(this).parents('.estado_habitacion_row_container').attr('estado_habitacion_id');
		$('div#myModalDeleteEstadoHabitacion').attr('estado_habitacion_id', estado_habitacion_id);
	});
	
	$body.off('click','div#myModalDeleteEstadoHabitacion .eliminar-estado-habitacion-trigger');
	$body.on('click','div#myModalDeleteEstadoHabitacion .eliminar-estado-habitacion-trigger', function(){
		estado_habitacion_id = $('div#myModalDeleteEstadoHabitacion').attr('estado_habitacion_id');
		estado_habitacion.deleteEstadoHabitacione(estado_habitacion_id);
	});
	
	/* CREAR EMPRESA DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-nombre-estado-habitacion').keypress(function(e) {
		if(e.which == 13) {
			estado_habitacion.saveEstadoHabitacioneModal();
			return false;
		}
	});
	
	$body.off('click','#btn-open-create-estado-habitacion');
	$body.on('click','#btn-open-create-estado-habitacion',function(){
		$('#txt-nombre-estado-habitacion').val('');
	});
	
	
	$body.off('click','.save-estado-habitacion-modal-trigger');
	$body.on('click','.save-estado-habitacion-modal-trigger',function(){
		estado_habitacion.saveEstadoHabitacioneModal();
	});
	
	

})