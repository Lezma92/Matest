<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <title>Nuevo usuario</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
    <script type="text/javascript" src="../js/sweetalert2.all.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    
</head>

<body>

    <?php include('../modules/menu-nav.php');  ?>

    <div class="container mt-5">
        <?php require_once("../controlador/receptor.php"); ?>
        <?php require_once("../controlador/operaciones.php"); ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#registerU">Registrar usuario</button>
        <br><br>
        <table class="table table-hover table-bordered table-striped tablaUser">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Tipo de usuario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
               <?php $resultado = Operaciones::getUsers(); 
               $cont = 0;
               foreach ($resultado as $key => $value) {

                if ($value["nivel_usuario"] != "Support") {
                    # code...
                    $cont++;
                    ?>

                    <tr>
                        <th scope="row"><?php echo($cont); ?></th>
                        <td scope="row"><?php echo($value["nombre"]." ".$value["app"]." ".$value["apm"]) ?></td>
                        <td scope="row"><?php echo($value["nick"]) ?></td>
                        <td scope="row"><?php echo($value["tipo_usuario"]) ?></td>
                        <td scope="row">
                            <button class="btn btn-sm btn-info modificarUser"  <?php echo("idDato = '".$value["idDatos"]."' idUser ='".$value["idUsu"]."'") ?> data-toggle="modal" data-target="#update">Modificar</button>
                            <button class="btn btn-sm eliminarUser" <?php echo("id_user = '".$value["idUsu"]."'") ?> style="background:#FF2930;color:#FFF;">Eliminar</button>
                        </td>

                    </tr>
                    <?php 
                }
            } ?>
        </tbody>
    </table>
    <?php include('../modules/modal_users.php');?>
</div>

<?php include("../modules/modal_update.php"); ?>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script>
    function shPss() {
        var tipo = document.getElementById("password");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
</script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/tabla.js"></script>
</body>

</html>
