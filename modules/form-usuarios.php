<style>
  .btn, .btn-large, .btn-small {
    text-decoration: none;
    color: #fff;
    background-color: #865f46 !important;
    text-align: center;
    letter-spacing: .5px;
  }
</style>

<div class="container section">
    <form method="POST" action="" class="validate col s12 m12 l12">
      <div class="row">

        <div class="input-field col s12 m4 l6">
          <input id="name" type="text" class="validate" name="name" minlength="3" maxlength="15" required>
          <label for="name">Nombre</label>
          <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
        </div>

        <div class="input-field col s12 m4 l6">
          <input id="app" type="text" class="validate" minlength="3" maxlength="15" required>
          <label for="app">Apellido paterno</label>
          <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
        </div>

        <div class="input-field col s12 m4 l6">
          <input id="apm" type="text" class="validate" minlength="3" maxlength="15" required>
          <label for="apm">Apellido materno</label>
          <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
        </div>

        <div class="input-field col s12 m4 l6 ">
          <input id="username" type="text" class="validate" name="user" minlength="3" maxlength="15" required>
          <label for="username">Usuario</label>
          <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
        </div>

        <div class="input-field col s12 m4 l6">
          <input id="password" type="password" class="validate" name="pass" minlength="3" maxlength="10" required>
          <label for="password">Contraseña</label>
          <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
        </div>

      </div>
        <div class="center-align"> <br><hr style="width:35%"> <br>
          <a href="#!" class="btn btn-small waves-effect waves-red">Registrar usuario</a>
        </div>  <br><hr style="width:35%">
    </form>
  </div>
