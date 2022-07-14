<label for="nombre">Nombre:</label><br>
          <input type="text" name="nombre" id="nombre"><br>
          <label for="app">Apellido Paterno:</label><br>
          <input type="text" name="app" id="app"><br>
          <label for="apm">Apellido Materno:</label><br>
          <input type="text" name="apm" id="apm">
          <br><br>
          <select name="carreras" id="carreras" class="carreras">
          <option>seleccionar</option>
          <?php    
            $carrera = Operaciones::getCarreras("carreras",null,null);
            $value;
            foreach ($carrera as $key => $value) {
              echo '<option value="'.$value["id"].'" pre="'.$value["id"].'">'.$value["nombre"].'</option>';
            } 
          ?>
    </select><br><br>

    <select id="grupos" class="grupos" name="grupos" required>
      <option value="" disabled selected><--seleccionar--></option>
    </select><br><br>
    <select name="asesor">
      <option><--seleccionar--></option>
      <?php 
        $asesor = Operaciones::getAsesores();
        $valor;
        foreach ($asesor as $key => $valor) {
          echo '<option value="'.$valor["id"].'" pre="'.$valor["id"].'">'.$valor["nombre"].'</option>';
        }
       ?>
    </select><br><br>
    <button type="submit" name="registrarAlumno">Enviar</button>
    <?php 
      nuevo::registrar();
     ?>