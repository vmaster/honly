$(document).ready(function(){
	Usuario = this;
	$body = $('body');
	
	usuario = {
	openAddEditUsuario: function(usuario_id){
		if(usuario_id == undefined || !usuario_id) usuario_id ='';
		$('div#usuario #add_edit_usuario_container').load('add_edit_usuario/'+usuario_id,function(){
			/*Global.setPlaces('EducationPlace','education');
			$(".icon-search-education-place").click(function (e) {
				$('#EducationPlaceEdit').val('');
				$('#EducationPlaceId').val('');				
				$('.row-education-place').toggle();
				$('#EducationPlaceEdit').focus();
			});
			
			var targetOffset =$('#add_edit_usuario_container').offset().top-130; 
			$('html,body').animate({scrollTop: targetOffset}, 700);*/
		});

	}}
	
	/* Mostrar formulario: Crear Usuario */
	$body.on('click', 'div#usuario .add-edit-usuario-trigger' , function(){
		usuario_id = $(this).attr('usuario_id');
		usuario.openAddEditUsuario(usuario_id);
	});
	
	$body.on('click','div#usuario .btn-cancelar-crear-usuario', function(){
		$('.form-crear-usuario').hide();
	});
	
	/* Agregar una fila a la grilla de lista de usuarios */
	function afterCrearUsuario(usuario_id){
		$.get('get_usuario_row/'+usuario_id,function(data){
			usuario_row_element = $('.usuario_row_container[usuario_id='+usuario_id+']');
			if(usuario_row_element.length > 0){//Update the row
				usuario_row_element.replaceWith(data);
			}else{//add new row
				$('#table_usuarios .conteiner_all_rows').append(data);
			}
		});
	}
	
	$body.on('click','.trigger_crear_usuario',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				//Global.displaySuccess(data.msg);
				User.afterCrearUsuario(data.usuario_id);
				$('#form-crear-usuario').html('');
				/*var targetOffset =$('fieldset#education').offset().top-130; 
				$('html,body').animate({scrollTop: targetOffset}, 700);
				$('#education .alert-info').remove();*/
			}else{
				$.each( data.validation, function( key, value ) {
					Global.displayError(value[0]);
					$('[name="data[Usuario]['+key+']"]').parent().addClass('control-group error');
					$('[name="data[Usuario]['+key+']"]').change(function() {
						$('[name="data[Usuario]['+key+']"]').parent().removeClass('control-group error');
					});
				});
			}
		});
	});
});