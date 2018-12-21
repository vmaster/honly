
$(document).ready(function(){
	
	Habitacion = this;
	$body = $('body');
	
	habitacion = {
		openAddEditHabitacion: function(habitacion_id){
			if(habitacion_id == undefined || !habitacion_id) {
				habitacion_id ='';
			}
			
			$('div#habitacion #add_edit_habitacion_container').unbind();
			$('div#habitacion #add_edit_habitacion_container').load(env_webroot_script + 'habitaciones/add_edit_habitacion/'+habitacion_id,function(){
				//alert();
			});
		},
		
		deleteHabitacion: function(habitacion_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'habitaciones/delete_habitacion',
				data:{
					'habitacion_id': habitacion_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.habitacion_row_container[habitacion_id='+habitacion_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveHabitacioneMantenimiento: function(){
			$form = $('.btn_crear_habitacion_trigger').parents('form').eq(0);
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_habitacion').hide();
					$('#conteiner_all_rows').load(env_webroot_script + escape('habitaciones/find_habitaciones/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#table_content_habitaciones').DataTable();
					});
					alertify.success(data.msg);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Habitacione]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Habitacione]['+key+']"]').change(function() {
							$('[name="data[Habitacione]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		},
		
		saveHabitacioneModal: function(){
			$form = $('form#form_create_habitacion').eq(0);
			$.ajax({
				url: env_webroot_script + 'habitaciones/add_habitacion',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddHabitacione').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_habitacion = $('#txt-nombre-habitacion').val();
					$('#txt-nombre-habitacion').val('');
					new_option = "<option value='" + data.Habitacione_id + "'>"+txt_habitacion+"</option>";
					$('.cbo-habitacions-select2 option:last').after(new_option);
					$(".cbo-habitacions-select2").select2("val", [data.Habitacione_id ,txt_habitacion]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Habitacione]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Habitacione]['+key+']"]').change(function() {
							$('[name="data[Habitacione]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear Habitacione */
	$body.off('click','div#habitacion .btn-nuevo-habitacion');
	$body.on('click', 'div#habitacion .btn-nuevo-habitacion' , function(){
		habitacion_id = $(this).attr('habitacion_id');
		habitacion.openAddEditHabitacion(habitacion_id);
	});
	
	/* Ocultar formulario Crear Habitacione*/
	$body.on('click','div#div-crear-habitacion .btn-cancelar-crear-habitacion', function(){
		$('#add_edit_habitacion').hide();
	});
	
	$body.off('click','.btn_crear_habitacion_trigger');
	$body.on('click','.btn_crear_habitacion_trigger',function(){
		habitacion.saveHabitacioneMantenimiento();
	});


	$body.off('click','div#habitacion .edit-habitacion-trigger');
	$body.on('click','div#habitacion .edit-habitacion-trigger', function(){
		habitacion_id = $(this).parents('.habitacion_row_container').attr('habitacion_id');
		habitacion.openAddEditHabitacion(habitacion_id);
	});
	
	$body.off('click','div#habitacion .open-model-delete-habitacion');
	$body.on('click','div#habitacion .open-model-delete-habitacion', function(){
		habitacion_id = $(this).parents('.habitacion_row_container').attr('habitacion_id');
		$('div#myModalDeleteHabitacion').attr('habitacion_id', habitacion_id);
	});
	
	$body.off('click','div#myModalDeleteHabitacion .eliminar-habitacion-trigger');
	$body.on('click','div#myModalDeleteHabitacion .eliminar-habitacion-trigger', function(){
		habitacion_id = $('div#myModalDeleteHabitacion').attr('habitacion_id');
		habitacion.deleteHabitacion(habitacion_id);
	});
	
	/* CREAR EMPRESA DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-nombre-habitacion').keypress(function(e) {
		if(e.which == 13) {
			habitacion.saveHabitacioneModal();
			return false;
		}
	});
	
	$body.off('click','#btn-open-create-habitacion');
	$body.on('click','#btn-open-create-habitacion',function(){
		$('#txt-nombre-habitacion').val('');
	});
	
	
	$body.off('click','.save-habitacion-modal-trigger');
	$body.on('click','.save-habitacion-modal-trigger',function(){
		habitacion.saveHabitacioneModal();
	});
	
	
})