


<div class="modal fade" id="ses" tabindex="-1" role="dialog" aria-labelledby="tit" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white" style="background-image: linear-gradient(to top, #3478e3, #3a71e1, #426bdf, #4964dc, #515cd8);">
				<h5 class="modal-title" id="tit"><strong>Iniciar sesión</strong></h5>

				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<form class="was-validated px-4 py-3" method="POST" name="formLoginUser">
					<div class="form-group">
						<label for="usuario">Usuario:</label>
						<input type="text" id="usuario" name="iptUser" title="Sólo letras mínusculas - mayúsuculas -  mínimo 3, máximo 20 carácteres" class="form-control" placeholder="Usuario" onpaste="return false" minlength="3" maxlength="20" required>
					</div>
					<div class="form-group">
						<label for="password">Contraseña:</label>
						<input type="password" class="form-control" name="iptPassword" id="password" placeholder="Contraseña" title="Sólo letras mínusculas - mayúsuculas -  mínimo 3, máximo 20 carácteres" onpaste="return false" minlength="3" maxlength="20" required>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
						<button type="submit" name="btnAcceso" value="btnAcceso" class="btn btn-info btn-sm">Ingresar</button>
						
					</div>
					<?php nuevo::acceso(); ?>
				</form>
			</div>
			
		</div>
	</div>
</div>	




<!-- MODIFICADO -->