$(document).ready(function(){
	
	RolPersona = this;
	$body = $('body');
	
	rol_persona = {
	
		openAddEditRolPersona: function(persona_id, persona_nombre){
			alert("id: " + persona_id);return false;
			$('div#rol_persona #add_edit_rol_persona_container').load(escape('RolRolPersonas/add_edit_rol_persona/'+persona_id+'/'+persona_nombre),function(){
				
			});
		}
	}
	
	/* Ocultar formulario Crear RolPersona*/
	$body.on('click','div#div-crear-rol-persona .btn-cancelar-crear-rol-persona', function(){
		$('#div-crear-rol-persona').fadeOut();
	});
	
	/* Mostrar formulario: Crear RolRolPersona */
	$body.off('click','div#rol_persona .btn-nuevo-rol-persona');
	$body.on('click', 'div#rol_persona .btn-nuevo-rol-persona' , function(){
		persona_id = $('div#rol_persona').attr('persona_id');
		persona_nombre = $('div#rol_persona').attr('persona_nombre');

		persona.openAddEditRolPersona(persona_id, persona_nombre);
	});
	
	$body.off('click','.btn_crear_rol_persona_trigger');
	$body.on('click','.btn_crear_rol_persona_trigger',function(){
		$persona_id = $(this).parents('#rol_persona').attr('persona_id');
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-rol-persona').fadeOut();
				$('#conteiner_all_rows').load(env_webroot_script + escape('rol_personas/find_rol_personas/'+ persona_id),function(){
					//$('#dtable_personas').DataTable();
				});
				//toastr.success(data.msg);
			}else{
				$.each( data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[RolPersona]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[RolPersona]['+key+']"]').change(function() {
						$('[name="data[RolPersona]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#rol_persona .edit-persona-trigger');
	$body.on('click','div#rol_persona .edit-persona-trigger', function(){
		persona_id = $(this).parents('.persona_row_container').attr('persona_id');
		persona.openAddEditRolPersona(persona_id);
	});
	
	/* Agregar una fila a la grilla de lista de personas */
	function afterCrearRolPersona(persona_id){
		$.get('get_persona_row/'+persona_id,function(data){
			persona_row_element = $('.persona_row_container[persona_id='+persona_id+']');
			if(persona_row_element.length > 0){//Update the row
				persona_row_element.replaceWith(data);
			}else{//add new row
				$('#table_personas .conteiner_all_rows').append(data);
			}
		});
	}
	
	$body.on('change','.cboTipoRolPersonas', function(){
		var id = $(this).val();
		var persona_id = '';
		loadDocumentos(id, persona_id);
	})
	
	$body.on('change','.cboDepartamentos', function(){
		var id=$(this).val(); 
        var departamento = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: "personas/ajax_list_provincias",
          data: { departamento_id: id , departamento_nombre : departamento },
          cache: false,
          success: function(html)
           {
             $(".cboProvincia").html(html);
             $(".cboProvincia").removeAttr('disabled');
             loadDistrito($(".cboProvincia").val());
           }
        })
	});
	
	
});