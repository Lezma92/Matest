

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Alumnos
    
    </h1>
   

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Alumnos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVersion">    
          Agregar Versión
        </button>
        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Carrera</th>
           <th>Grupo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
        $id_carrera = $_GET["id"];
     

        $carrera = ControladorAlumnos::ObtenerAlumnos($id_carrera);
          foreach ($carrera as $key => $value) {


           
            echo ' <tr>

                    <td>'.($key+1).'</td>';
                    

            echo'   <td class="text-uppercase">'.$value["nombre"].'</td>';

            echo'   <td class="text-uppercase">'.$value["grupo"].'</td>';

                  

            echo'   <td>

                      <div class="btn-group">
                          
                        <a target="_blank" href="index.php?ruta=alumno&idA='.$value["id"].'&grupo='.$value["grupo"].'"><button class="btn btn-success" ><i class="far fa-chart-bar"></i></button></a>


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
  include "Modales/modal_grafica.php";

 





 
 ?>