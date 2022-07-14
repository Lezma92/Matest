<?php 
class alertas{
	function alertBasic($mensaje,$otro){
		echo"<script>Swal.fire(
		'$mensaje!',
		'$otro!',
		'success'
		)
		</script>";
	}
	function alertTipos($tipo,$mensaje){
		echo("<script>Swal.fire({
			type: '$tipo',
			title: 'Oops...',
			text: '$mensaje!'
		})</script>");
	}

	function alertCloseAuto($msj1,$msj2){
		echo("<script>let timerInterval
			Swal.fire({
				title: '$msj1!',
				html: '$msj2',
				timer: 3000,
				onBeforeOpen: () => {
					Swal.showLoading()
					timerInterval = setInterval(() => {
						Swal.getContent().querySelector('strong')
						.textContent = Swal.getTimerLeft()
						}, 100)
						},
						onClose: () => {
							clearInterval(timerInterval)
						}
						}).then((result) => {
							if (
    // Read more about handling dismissals
							result.dismiss === Swal.DismissReason.timer
							) {
								console.log('I was closed by the timer')
								window.location='index.php';
							}
						})</script>");
		return "ok";

	}
	function alertConfirm(){
		echo("<script>Swal.fire({
			title: 'Are you sure?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
				}
			})</script>");
	}
}

?>