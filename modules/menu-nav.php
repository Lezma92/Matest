

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-image: linear-gradient(to top, #3478e3, #3a71e1, #426bdf, #4964dc, #515cd8);">
	<a class="navbar-brand" href="../admin/index.php">
		<img src="../img/ico/mat.ico" width="30" height="30" class="d-inline-block align-top" alt="">
		MATEST
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
		<ul class="navbar-nav ">
			<li class="nav-item active ">
				<a class="nav-link text-white" href="../admin/index.php">Inicio<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Examenes</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item text-primary" href="../admin/t_new.php">Nuevo</a>
					<a class="dropdown-item text-primary" href="../admin/table_exam.php">Activar/desactivar</a>
					<a class="dropdown-item text-primary" href="../admin/add_questions.php">Agregar preguntas</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Estadisticas</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item text-primary" href="../admin/graf-general.php">General</a>
					<a class="dropdown-item text-primary" href="../admin/graf-grupos.php">Grupo</a>
					<a class="dropdown-item text-primary" href="../admin/view-alumnos.php">Alumnos</a>
				</div>
			</li>
		
			<li class="nav-item">
				<a class="nav-link text-white" href="../admin/add_users.php">Usuarios</a>
			</li>
			<li class="nav-item">
				<a href="../views/index.php" class="nav-link text-white bg-danger btn-sm">Cerrar sesión</a>
			</li>
		</ul>
		
	</div>
</nav>