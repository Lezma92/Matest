<!-- Modal -->
<div class="modal fade" id="registerU" tabindex="-1" role="dialog" aria-labelledby="registerUT" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-image: linear-gradient(to top, #3478e3, #3a71e1, #426bdf, #4964dc, #515cd8);">
                <h5 class="modal-title" id="registerUT">Registro de usuarios</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" class="was-validated">
                    <div class="form-row">

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="nom" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" name="nom" id="nom" placeholder="Campo obligatorio*" minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="app" class="col-form-label">Apellido paterno:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" id="app" name="app" placeholder="Campo obligatorio*" minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="apm" class="col-form-label">Apellido materno:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" id="apm" name="apm" placeholder="Campo obligatorio*" minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="tipo" class="col-form-label">Tipo de usuario:</label>
                            <select name="tipo" id="tipo" class="custom-select" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="Admin">Administrador</option>
                                <option value="Maestro">Maestro</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="username" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Campo obligatorio*" minlength="3" maxlength="25" required>
                            
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Campo obligatorio*" minlength="3" maxlength="25" required>
                            
                        </div>
                        

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="registrarUsuario" value="registrarUsuario" class="btn btn-info btn-sm">Regitrar usuario</button>
                    </div>
                    <?php nuevo::registrar();              ?>
                </form>
            </div>
            <!--modal content-->
        </div>
    </div>

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