$(document).ready(function(){
	
	Persona = this;
	$body = $('body');
	
	persona = {
		openAddEditPersona: function(persona_id){
			if(persona_id == undefined || !persona_id) {
				persona_id ='';
				//tipo_persona_id = '';
				//var_tipo_persona_id
			}else{
				addMaxLengthNroDoc();
				setTimeout(function(){
					$(".cboProvincia").removeAttr('disabled');
					$(".cboDistrito").removeAttr('disabled');
				},1000)
				//var_tipo_persona_id = tipo_persona_id;
			}

			//alert(persona_id);
			
			$('div#persona #add_edit_persona_container').unbind();
			$('div#persona #add_edit_persona_container').load(env_webroot_script + escape('personas/add_edit_persona/'+persona_id),function(){
				
				
				//persona_id = $('div#rol_persona').attr('persona_id');

				tipo_persona_id = $('#cbo-tipo-personas').find('option:selected').val();

				loadDocumentos(tipo_persona_id, persona_id);
				hideByJuridica();
				 
				
				/*Global.setPlaces('EducationPlace','education');
				$(".icon-search-education-place").click(function (e) {
					$('#EducationPlaceEdit').val('');
					$('#EducationPlaceId').val('');				
					$('.row-education-place').toggle();
					$('#EducationPlaceEdit').focus();
				});
				
				var targetOffset =$('#add_edit_persona_container').offset().top-130; 
				$('html,body').animate({scrollTop: targetOffset}, 700);*/
			});
		},
	
		openAddEditRolPersona: function(persona_id, persona_nombre){
			//alert(persona_nombre);
			$('div#rol_persona #add_edit_rol_persona_container').load(env_webroot_script + escape('RolPersonas/add_edit_rol_persona/'+persona_id+'/'+persona_nombre),function(){
				
			});
		},

		deletePersona: function(persona_id){

			$.ajax({
				type: 'post',
				url: env_webroot_script + 'personas/delete_persona',
				data:{
					'persona_id': persona_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					//$('.div-row-persona[persona_id='+persona_id+']').fadeOut(function(){$(this).parents('tr').remove()});
					$('#data_rol[persona_id'+persona_id+']').fadeOut(function(){$(this).parents('tr').remove()});

					//$('.persona_row_container[persona_id='+persona_id+']').fadeOut(function (){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.success(data.msg);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Persona */
	$body.off('click','div#persona .btn-nuevo-persona');
	$body.on('click', 'div#persona .btn-nuevo-persona' , function(){
		persona_id = $(this).attr('persona_id');
		//tipo_persona_id = "";
		persona.openAddEditPersona(persona_id);
	});
	
	/* Ocultar formulario Crear Persona*/
	$body.on('click','div#div-crear-persona .btn-cancelar-crear-persona', function(){
		$('#add_edit_persona').hide();
	});
	
	/* Mostrar formulario: Crear RolPersona */
	$body.off('click','div#rol_persona .btn-nuevo-rol-persona');
	$body.on('click', 'div#rol_persona .btn-nuevo-rol-persona' , function(){
		persona_id = $('div#rol_persona').attr('persona_id');
		persona_nombre = $('div#rol_persona').attr('persona_nombre');
		persona.openAddEditRolPersona(persona_id, persona_nombre);
	});
	
	/* Ocultar formulario Crear RolPersona*/
	$body.on('click','div#div-crear-rol-persona .btn-cancelar-crear-persona', function(){
		$('#add_edit_persona').hide();
	});
	
	$body.off('click','.btn_crear_persona_trigger');
	$body.on('click','.btn_crear_persona_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		//alert($form);return false;
		$.ajax({
			//url: "personas/add_edit_persona/",
			url: $form.attr('action'),
			//data: $('#add_edit_persona').serialize(),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_persona').hide();
				alertify.success(data.msg);

				$('#conteiner_all_rows').load(env_webroot_script + escape('personas/find_personas/1/'+null+'/'+null+'/'+null),function(){
					 $('#table_content_personas').DataTable({
				    	//'ajax': env_webroot_script + 'personas/ajax_list_personas'
				    	ajax: {
				    		url: env_webroot_script + 'personas/ajax_list_personas',
				    		dataSrc: 'data'
				    		//"dataSrc": "tableData"
				    	}
				    });
				});

			}else{
				$.each( data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Persona]['+key+']"]').parent().addClass('control-group error');
					$('[name="data[Persona]['+key+']"]').change(function() {
						$('[name="data[Persona]['+key+']"]').parent().removeClass('control-group error');
					});
				});
			}
		});
	});

	$body.off('click','div#persona .edit-persona-trigger');
	$body.on('click','div#persona .edit-persona-trigger', function(){
		persona_id = $(this).parents('.div-row-persona').attr('persona_id');
		//alert(persona_id); return false;
		//tipo_persona_id = $(this).parents('.persona_row_container').attr('tipo_persona_id');
		persona.openAddEditPersona(persona_id);
	});

	$body.off('click','div#myModalDeletePersona .delete-persona-trigger');
	$body.on('click', 'div#myModalDeletePersona .delete-persona-trigger', function(){
		persona_id = $('div#myModalDeletePersona').attr('persona_id');
		persona.deletePersona(persona_id);
		//alert();
	});

	$body.off('click','div#persona .open-model-delete-persona');
	$body.on('click','div#persona .open-model-delete-persona', function(){
		//alert();
		persona_id = $(this).parents('#data_rol').attr('persona_id');
		$('div#myModalDeletePersona').attr('persona_id', persona_id);
	});
	
	/* Agregar una fila a la grilla de lista de personas */
	function afterCrearPersona(persona_id){
		$.get('get_persona_row/'+persona_id,function(data){
			persona_row_element = $('.persona_row_container[persona_id='+persona_id+']');
			if(persona_row_element.length > 0){//Update the row
				persona_row_element.replaceWith(data);
			}else{//add new row
				$('#table_personas .conteiner_all_rows').append(data);
			}
		});
	}
	
	$body.on('change','.cboTipoPersonas', function(){
		var id = $(this).val();
		var persona_id = '';
		loadDocumentos(id, persona_id);
	})
	
	$body.on('change','.cboDepartamentos', function(){
		var id=$(this).val(); 
        var departamento = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: env_webroot_script + "personas/ajax_list_provincias",
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
	
	$body.on('change','.cboProvincia', function(){
		var id=$(this).val(); 
		 loadDistrito(id);
	});
	
	$body.on('change','#cboNroDocumento', function(){
		addMaxLengthNroDoc();
	})
	
	/* Cargar documentos según el tipo de persona */
	function loadDocumentos(tipo_persona_id, persona_id){
		//if(persona_id == undefined || !persona_id) persona_id ='';
		$.ajax({
			type: "POST",
			url: env_webroot_script + "personas/ajax_list_tipo_documentos",
			data: { tipo_persona_id: tipo_persona_id, persona_id_doc: persona_id },
			cache: false,
			success: function(html)
			{
				$(".cboNroDocumento").html(html);
				$(".cboNroDocumento").removeAttr('disabled');
				hideByJuridica();
				addMaxLengthNroDoc();
			}
		})
	}
	
	function loadDistrito(provincia_id){
		var id=$(".cboProvincia").val(); 
        //var region = $(".cboRegion").find('option:selected').html();
        $.ajax({
          type: "POST",
          url: env_webroot_script + "personas/ajax_list_distritos",
          data: { provincia_id: provincia_id },
          cache: false,
          success: function(html)
           {
             $(".cboDistrito").html(html);
             $(".cboDistrito").removeAttr('disabled');
           }
        })
	}
	
	/* Ocultar componentes según el tipo persona JURIDICA */
	function hideByJuridica(){
		if($('.cboTipoPersonas').val() == 3){
			$('#lblNombre').hide();
			$('#txtApellido').hide();
			$('#lblApellido').hide();
			$('#lblRznSocial').show();
			$('#lblSexo').hide();
			$('#cboSexo').hide();
			$('#lblEstCivil').hide();
			$('#cboEstadoCivil').hide();
			$('#lblFecNacimiento').hide();
			$('#txtFechaNacimiento').hide();
			$('.cboRol').find('option[value=2]').hide(); //Ocultar Rol de tipo Personal
		}else{
			$('#lblNombre').show();
			$('#txtApellido').show();
			$('#lblApellido').show();
			$('#lblRznSocial').hide();
			$('#lblSexo').show();
			$('#cboSexo').show();
			$('#lblEstCivil').show();
			$('#cboEstadoCivil').show();
			$('#lblFecNacimiento').show();
			$('#txtFechaNacimiento').show();
			$('.cboRol').find('option[value=2]').show();
		}
	}
	
	function addMaxLengthNroDoc(){
		/* Agregando Maxlength según el Tipo de Doc*/
		if($('#cboNroDocumento').val() == 1){
			$('#PersonaNroDocumento').attr('maxlength','8'); //DNI
		}

		if($('#cboNroDocumento').val() == 2){
			$('#PersonaNroDocumento').attr('maxlength','12'); //CARN EXT
		}

		if($('#cboNroDocumento').val() == 3){
			$('#PersonaNroDocumento').attr('maxlength','11'); //RUC
		}
	}
	
	
	/* Query Events of Roles */
	$body.off('click','div#persona .link_roles');
	$body.on('click','div#persona .link_roles', function(){
		persona_id = $(this).parent('#data_rol').attr('persona_id');
		persona_nombre = $(this).parent('#data_rol').attr('persona_nombre');

		$('div.content').load(env_webroot_script + escape('RolPersonas/list_roles_personas/'+persona_id+'/'+persona_nombre),function(){
		});
	});
	
	
	
});