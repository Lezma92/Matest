
<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Página principal</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
</head>
<body>

  <?php require '../modules/menu-nav.php'; ?>
  <div class="">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel" >
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" data-interval="3000">
          <img src="../img/me/img1.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item" data-interval="3000">
          <img src="../img/me/img6.jpg" class="d-block w-100">
        </div>
       
      </div>
    </div>
  </div>

  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>
