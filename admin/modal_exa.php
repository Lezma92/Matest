
<!-- Modal registrar examen -->
<div class="modal fade" id="exa" tabindex="-1" role="dialog" aria-labelledby="exam" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header text-white"  style="background-image: linear-gradient(to top, #3478e3, #3a71e1, #426bdf, #4964dc, #515cd8);">
        <h5 class="modal-title" id="exam">Registrar examen</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" class="was-validated">

          <div class="form-row">
            <div class="form-group col-md-12 col-lg-12">
              <label for="exa" >Nombre examen:</label>
              <input type="text" name="exa" id="exa" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="btnGuardarExamen" class="btn btn-info btn-sm">Guardar examen</button>
        </div>
        <?php nuevo::insertExamenes(); ?>
      </form>
    </div>
  </div>
</div>