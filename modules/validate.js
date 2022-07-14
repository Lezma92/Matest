function validate() {
    var matricula, carreras;
    
    matricula = document.getElementById("matricula").value;

    if(matricula == "") {

        alert("Favor de no dejar vacío el campo matrícula.");
        return false;

    } else  if(matricula.length>8) {

        alert("La matrícula debe tener máximo 8 caracteres.");
        return false;

    } else if(matricula.length<8){

        alert("La matrícula mínimo debe tener 8 caracteres.");
        return false;

    }

    /* if(carreras != 0) {

        alert("Favor de escoger una carrera.");
        return false;
    } */

}