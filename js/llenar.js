
$(".formAlumno").on("change","select.carreras", function(){
 document.getElementById("grupos").options.length=0;
 var idCarrera = $(this).val();
 console.log(idCarrera);

 var datos = new FormData();
 datos.append("idCarrera", idCarrera);
 $.ajax({
  url: "../controlador/grupos.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  dataType:"json",
  success: function(respuesta){
    console.log(respuesta[0]);
    document.getElementById("grupos").innerHTML += '<option value=""  disabled selected>seleccionar</option>'; 
    respuesta.forEach(function(element) {
     document.getElementById("grupos").innerHTML += "<option value='"+element["id"]+"'>"+element["grupo"]+"</option>"; 

   });             
  }
})
})

function cambiarGrafica(){
 var select = document.formGraficas.version.selectedIndex;
 var idVersion = document.formGraficas.version.options[select].value;
 console.log(idVersion);

 var datos = new FormData();
 datos.append("idVersion", idVersion);
 if (select > 0) {
  $.ajax({
    url: "../controlador/opc_graficas.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){
      console.log(respuesta);
      console.log(respuesta.length);
      if (respuesta.length>0) {
        respuesta.forEach(function(element) {
          window.location.href = "../admin/graf-general.php?idVersion="+idVersion;
        });  
      }else{
        Swal.fire(
          'No se encontraron registros previos del examen, no es posible graficar',
          'El examen no ha sido aplicado ninguna vez...',
          'error'
          )
      }

    }
  })

}

}

function llenarAlumnos(){
 var select1 = document.formAlumno.grupos.selectedIndex;
 var idGrupo = document.formAlumno.grupos.options[select1].value;
 var grupo = document.formAlumno.grupos.options[select1].text;
 var datos = new FormData();
 console.log(idGrupo);
 datos.append("idGrupo", idGrupo);
 datos.append("grupo",grupo);
 $.ajax({
  url: "../controlador/opc_graficas.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  dataType:"json",
  success: function(respuesta){
    console.log(respuesta);
    if (respuesta.length) {
         window.location.href = "../admin/view-alumnos.php?idGrupo="+idGrupo+"&grupo="+grupo;
    }else{
      Swal.fire(
          'No se encontraron alumnos para mostrar',
          'Sin datos existentes...',
          'error'
          )
    }     
  }
})

}



function cambiarGraficaGrupo(){
 var select1 = document.fomGraGru.carreras.selectedIndex;
 var idCarrera = document.fomGraGru.carreras.options[select1].value;

 console.log(idCarrera);
 var datos = new FormData();
 datos.append("id_carrera", idCarrera);

 if (idCarrera > 0) {
  $.ajax({
    url: "../controlador/opc_graficas.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){
      console.log(respuesta);
      console.log(respuesta.length);
      if (respuesta.length>0) {
        respuesta.forEach(function(element) {
          window.location.href = "../admin/graf-grupos.php?id_carrera="+idCarrera;
        });  
      }else{
        Swal.fire(
          'No se encontraron registros para graficar',
          'Intente más tarde...',
          'error'
          )
      }

    }
  })

}

}