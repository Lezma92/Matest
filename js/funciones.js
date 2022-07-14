function preguntar(id_user){
    Swal.fire({
        title: '¿Estas seguro(a) que deseas elminar el usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Aceptar!'
    }).then((result) => {
        if (result.value) {
            window.location.href = "../controlador/eliminar.php?opcion=deleteUser&id_user="+id_user;
        }
    })
}
function onlyL(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function ejemplo(){
    $(".tablas").on("click",".btnEliminarProveedor", function(){
     var idProveedor = $(this).attr("idProveedor");
     console.log(idProveedor);
     swal({
        title: '¿Está seguro de borrar proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar proveedor!'
    }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=provedores&idProveedor="+idProveedor;
        }

    })
})
}



