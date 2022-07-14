

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar carrera
    
    </h1>
   

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar categorías</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-header with-border">
  
        <a target="_blank" href="general"><button class="btn btn-warning" >Gráfica General</button></a>
        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Carrera</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $carrera = ControladorCarrera::ctrMostrarCarrera($item, $valor);

          foreach ($carrera as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>

                    <td>

                      <div class="btn-group">
                          

                        <a target="_blank" href="index.php?ruta=grupos&id='.$value["id"].'"><button class="btn btn-success" ><i class="far fa-chart-bar"></i></button></a>

                        <a href="index.php?ruta=alumnos&id='.$value["id"].'"><button class="btn btn-warning" ><i class="fa fa-user"></i></button></a>

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php 
// AGREGAR CARRERA
  include "Modales/modal_carreras/agregarCarrera.php";

// EDITAR CARRERA
  include "Modales/modal_carreras/editarCarrera.php"; 

// Agregar Grupo
  include "Modales/modal_carreras/agregarGrupo.php";



  $borrarCarrera = new ControladorCarrera();
  $borrarCarrera -> ctrBorrarCarrera();
 ?>