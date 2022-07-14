$(".tablaUser").on("click",".eliminarUser", function(){
	var id_user = $(this).attr("id_user");
	console.log(id_user);
	var datos = new FormData();
	datos.append("id_user", id_user);
	
	$.ajax({
		url: "../controlador/eliminar.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			console.log(respuesta[0]);

			if (respuesta[0]>0 && respuesta[0]!="V") {
				Swal.fire({
					type: 'error',
					title:"Este usuario cuenta con "+respuesta[0]+ " registros en respuestas, no es posible eliminarlo",
					text:"Para más información comunicate al area de soporte"
				})
			}else{
				Swal.fire({
					title: "¿Estas seguro(a) que deseas elminar el usuario?",
					text: "",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '¡Aceptar!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../controlador/eliminar.php?opcion="+id_user;
					}
				})
			}
			
		}
	})
	//mensaje = "Maaskadjhadhjadaj "+cantidad;
	
	
})

$(".tablaUser").on("click",".modificarUser",function(){

	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var datos = new FormData();
	datos.append("idDato",idDato);
	datos.append("idUser",idUser);

	console.log(idDato);
	console.log(idUser);


	$.ajax({

		url:"../controlador/update.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			console.log(respuesta);
			$("#idDato").val(idDato);
			$("#idUser").val(idUser);

			$("#nomUp").val(respuesta["nombre"]);
			$("#appUp").val(respuesta["app"]);
			$("#apmUp").val(respuesta["apm"]);
			$("#username_up").val(respuesta["nick"]);
			$("#tipoUp").html(respuesta["nivel_usuario"]);
			$("#tipoUp").val(respuesta["nivel_usuario"]);
			
			

			
		}

	})
})

$(".tablaExa").on("click",".btnEliminarPreguntas", function(){

	var id_examen = $(this).attr("id_examen");
	console.log(id_examen);
	var datos = new FormData();
	datos.append("id_examen", id_examen);

	$.ajax({
		url:"../controlador/eliminar.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			console.log(respuesta);
			if (respuesta.length > 0) {
				Swal.fire({
					type: 'error',
					title:"El examen cuenta con un historial previo de resultados, no es posible eliminar",
					text:"Para más información comunicate al area de soporte"
				})
			}else{
				Swal.fire({
					title: "¿Estas seguro(a) que deseas elminar el Examen?",
					text: "Al eliminar el examen se eliminará todo el historial que haya dentro de la base de datos",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '¡Aceptar!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../controlador/eliminar.php?idPre="+id_examen;
					}
				})
			}
		}

	})
	
	
	
	//mensaje = "Maaskadjhadhjadaj "+cantidad;
	
	
})

$(".tablaActivar").on("click",".btnActivar", function(){
	var idActivar = $(this).attr("idActivar");
	console.log(idActivar);
	var datos = new FormData();
	datos.append("idActivar", idActivar);
	$.ajax({
		url: "../controlador/grupos.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			$("#idActivar").val(idActivar);      
		}
	})


		//mensaje = "Maaskadjhadhjadaj "+cantidad;

	})

$(".tablaExa").on("click",".btnVerPre", function(){
	var ver_examen = $(this).attr("ver_examen");
	console.log(ver_examen);
	var datos = new FormData();
	datos.append("ver_examen", ver_examen);
	$.ajax({
		url: "../controlador/opc_graficas.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			if (respuesta.length > 0) {
				window.location.href = "../admin/vista_preg.php?ver_examen="+ver_examen;
			}else{
				Swal.fire(
					'Examen sin preguntas registradas',
					'',
					'error'
					)
			}
		}
	})


		//mensaje = "Maaskadjhadhjadaj "+cantidad;

	})

$(".tablaExa").on("click",".btnPreguntas", function(){
	var idPre = $(this).attr("idPre");
	console.log(idPre);
	var datos = new FormData();
	datos.append("idPre", idPre);
	$.ajax({
		url: "../admin/vista_preg.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			console.log(respuesta[0]);       
		}
	})
	window.location.href = "../admin/vista_preg.php";
		//mensaje = "Maaskadjhadhjadaj "+cantidad;

	})

function activar(){
	var select = document.formActivar.carrera.selectedIndex;
	var id_carrera = document.formActivar.carrera.options[select].value;
	var idExamen = $("#idActivar").val();
	console.log(id_carrera);
	console.log("id Examen= "+idExamen);
	var datos = new FormData();

	datos.append("id_carrera", id_carrera);
	$.ajax({
		url: "../controlador/update.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			console.log(respuesta);
			if (respuesta.length) {
				Swal.fire(
					'La carrera elejida ya cuenta con un versión de examen activa',
					'Es necesario desactivar la versión actual',
					'error'
					)
			}else{
				window.location.href = "../controlador/update.php?version="+idExamen+"&carrera="+id_carrera;
			}     
		}
	})

}

$(".tablaActivos").on("click",".btnDesactivar", function(){
	var id_version = $(".id_version").val();
	var id_carrera = $(".id_carrera").val();

	console.log(id_carrera);
	console.log(id_version);
	var datos = new FormData();
	
	datos.append("id_version",id_version);
	datos.append("idCarrera",id_carrera);

	Swal.fire({
		title: "¿Estas seguro(a) que deseas desactivar el Examen?",
		text: "...",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../controlador/update.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					console.log(respuesta);   
					if (respuesta["respuesta"]=="Bien") {
						Swal.fire({
							title: "Examen desactivado correctamente",
							text: "",
							type: "success",
							confirmButtonColor: "#3085d6",	
							confirmButtonText: "ok!"
						}).then((result) => {
							if (result.value) {
								window.location.href = "../admin/table_exam.php";
							}
						})
					}    
				}
			})
		}
	})
	
	
		//mensaje = "Maaskadjhadhjadaj "+cantidad;

	})

