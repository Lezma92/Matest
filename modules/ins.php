<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="../img/ico/mat.ico" />
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Empecemos!!</title>
</head>
<body>

<div class="container section">

  <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">INSTRUCCIONES</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="flow-text">Antes de comenzar...</h4>
      <p>Antes de realizar el siguiente examen de matemáticas deberá saber que una vez presionando el botón
        ya <b>no</b> podrás regresar, sin más que decir <b>EMPECEMOS</b> y mucha <b>suerte!! :D</b></p>
    </div>
    <div class="modal-footer">
      <a href="../views/questions.php" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
  </div>

</div>


<script src="../js/materialize.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.querySelectorAll('.modal');
        var op = M.Modal.init(el, {
            dismissible: false,
            opacity: 0.8,
            isOpen: true
        });
    });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/ljibs/materialize/1.0.0/js/materialize.min.js"></script> -->
</body>
</html>