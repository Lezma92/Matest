$(".Form_Preguntas").on("change", "input.pregunta_text", function(){
$(this).parent().parent().parent().children(".Pregunta").html(

 		'<div class="form-group Campo_Text">'+
              
        '<div class="form-group">'+
              
        '<span class="input-group-addon"><i class="fa fa-th"></i></span>'+ 
        '<textarea class="form-control" name="txt_pregunta" id="area_pregunta" rows="2" placeholder="Ingresar pregunta" required></textarea>'+

        '</div>'+

        '</div>');
})


$(".Form_Preguntas").on("change", "input.pregunta_foto", function(){
$(this).parent().parent().parent().children(".Pregunta").html(

 		'<div class="form-group">'+
              
              '<input type="file" class="FotoPregunta form-control-file" name="FotoPregunta" required="">'+

              '<input type="hidden" name="Subir_foto" value="0">'+

              '<p class="help-block">Peso máximo de la foto 2MB</p>'+
              '<img src="" class="img-thumbnail previ">'+

            '</div>');
$(".FotoPregunta").change(function(){

	console.log("ora puto");
	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".FotoPregunta").val("");
	console.log("ora puto");

  		 swal({
	

		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){


  		$(".FotoPregunta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previ").attr("src", rutaImagen);

  		})

  	}
})
})
// -----------------------------------------------------------------------

$(".Form_Preguntas").on("change", "input.respuestas_text", function(){
$(this).parent().parent().parent().children(".respuestas").html(

 		'<h4>Respuestas</h4>'+
          '<div class="form-group">'+

            '<div class="input-group col-xs-11">'+
            
              '<span class="input-group-addon">A)</span>'+ 

              '<input type="text" class="form-control input-lg" name="Respuesta_A" placeholder="Ingresar Respuesta a)" id="Respuesta_A" required>'+

            '</div>'+

             '<div class="col-lg-2">'+
                 '<input type="radio" class="radio_a" name="Ridios_respuesta" id="optionsRadios1" value="option1" required="" >'+
              '</div>'+
              
          '</div>'+

          '<div class="form-group">'+

            '<div class="input-group col-xs-11">'+
            
              '<span class="input-group-addon">B)</span>'+ 

              '<input type="text" class="form-control input-lg" name="Respuesta_B" placeholder="Ingresar Respuesta b)" id="Respuesta_B" required>'+

            '</div>'+

             '<div class="col-lg-2">'+
                 '<input type="radio" class="radio_a" name="Ridios_respuesta" id="optionsRadios2" value="option2" required="" >'+
              '</div>'+
              
          '</div>'+  

          '<div class="form-group">'+

            '<div class="input-group col-xs-11">'+
            
              '<span class="input-group-addon">C)</span>'+ 

              '<input type="text" class="form-control input-lg" name="Respuesta_C" placeholder="Ingresar Respuesta c)" id="Respuesta_C" required>'+

            '</div>'+

             '<div class="col-lg-2">'+
                 '<input type="radio" class="radio_a" name="Ridios_respuesta" id="optionsRadios3" value="option3" required="">'+
              '</div>'+
              
          '</div>'+

          '<div class="form-group">'+

            '<div class="input-group col-xs-11">'+
            
              '<span class="input-group-addon">D)</span>'+ 

              '<input type="text" class="form-control input-lg" name="Respuesta_D" placeholder="Ingresar Respuesta d)" id="Respuesta_D" required>'+

            '</div>'+

             '<div class="col-lg-2">'+
                 '<input type="radio" class="radio_a" name="Ridios_respuesta" id="optionsRadios4" value="option4" required="" >'+
              '</div>'+
              
          '</div>');
})

// -----------------------------------------------------------------------

$(".Form_Preguntas").on("change", "input.respuestas_foto", function(){
$(this).parent().parent().parent().children(".respuestas").html(

 		'<div class="form-group">'+

              '<input type="file" class="FotoRespuesta_2" name="FotoRespuesta_2" required="">'+

              '<input type="hidden" name="Subir_foto_respuesta" value="0">'+


              '<p class="help-block">Peso máximo de la foto 2MB</p>'+
              '<img src="" class="img-thumbnail previ_2">'+

              '<div class="radio col-sm-10">'+

            	
	              '<label class="col-lg-3">'+
	                '<input type="radio" class="respuestas_A_foto" name="Radios_respuesta_Foto" value="opc_1" required="">A)'+
	              '</label>'+
	            
	              '<label class="col-lg-3">'+
	                '<input type="radio" class="respuestas_B_foto" name="Radios_respuesta_Foto" value="opc_2" required="">B)'+
	              '</label>'+

	              '<label class="col-lg-3">'+
	                '<input type="radio" class="respuestas_C_foto" name="Radios_respuesta_Foto" value="opc_3" required="">C)'+
	              '</label>'+

	              '<label class="col-lg-3">'+
	                '<input type="radio" class="respuestas_D_foto" name="Radios_respuesta_Foto" value="opc_4" required="">D)'+
	              '</label>'+
	            

              '</div>'+

            '</div>');


$(".FotoRespuesta_2").change(function(){

	console.log("ora puto");
	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".FotoRespuesta_2").val("");
	console.log("ora puto");

  		 swal({
	

		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){


  		$(".FotoRespuesta_2").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previ_2").attr("src", rutaImagen);

  		})

  	}
})
})

