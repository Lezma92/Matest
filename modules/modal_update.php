<!-- Modal update -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateU" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header  text-white" style="background-image: linear-gradient(to top, #3478e3, #3a71e1, #426bdf, #4964dc, #515cd8);">
                <h5 class="modal-title" id="updateU">Actualizar usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" class="was-validated">
                    <div class="form-row">

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="nom" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" name="nom" id="nomUp"  minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="app" class="col-form-label">Apellido paterno:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" id="appUp" name="app"  minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="apm" class="col-form-label">Apellido materno:</label>
                            <input type="text" class="form-control" onkeypress="return onlyL(event);" onpaste="return false" id="apmUp" name="apm" minlength="3" maxlength="25" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="tipo" class="col-form-label">Tipo de usuario:</label>
                            <select name="tipo" id="tipo" class="custom-select" required>
                                <option value="" id="tipoUp"></option>
                                <option value="Admin">Administrador</option>
                                <option value="Maestro">Maestro</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="username_up" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" name="username" id="username_up" minlength="3" maxlength="25" required>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="password" name="password" class="form-control" id="password" minlength="3" maxlength="25" required>
                        </div>

                    </div>
                    <input type="hidden" name="idDato" id="idDato" value="">
                    <input type="hidden" name="idUser" id="idUser" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btnUpdate" class="btn btn-info btn-sm">Modificar usuario</button>

                    </div>
                    <?php nuevo::updateUser();  ?>
                </form>
            </div>
            <!--modal content-->
        </div>
    </div>
