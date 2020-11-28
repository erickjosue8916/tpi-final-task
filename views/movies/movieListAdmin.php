<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo  ">
	<main class="container">
		<div class="row h-auto min-vh-100 justify-content-center align-items-center">
			<div class="col">
				<?php
					$headers = ['#', 'Titulo', 'Descripcion', 'Imagen', 'Stock', 'Preciolquiler', 'PrecioVenta', 'Disponibilidad', 'Likes', 'Editar', 'Eliminar'];

					$rows = $result['peliculas'];
					$config = [
						'headers' => $headers,
						'rows' => $rows
					];
				?>
				<h1 class="text-center m-5 font-weight-light text-white display-4">Peliculas</h1>
				<section class="table-responsive">
					<table class="table-styles">
						<thead>
							<tr>
							<?php
							foreach ($headers as $key => $value) {//Por cada título en el arreglo creamos una columna
								?>
								<th><h1><?=$value?></h1></th>
								<?php
							}
							?>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($rows as $key => $cols) { //Por cada elemento en $rows creamos una fila
							?>
							<tr>
							<?php
								foreach ($cols as $key => $col) {//Accedemos a los valores que tiene almacenado cada fila uno a uno	
								?>
									<td><?=$col?></td><!--Agregamos ese valor a la fila correspondiente-->
								<?php
								}
							?>
							<td><a class="btn btn-outline-info text-capitalize" href="<?=BASE_DIR?>Peliculas/update&id=<?=$cols['id_pelicula']?>">Editar</a></td>
							<td><button type="button" class="btn btn-outline-danger text-capitalize" data-toggle="modal" data-target="#exampleModalCenter">Eliminar</button></td>
							</tr>
							<?php
							}
						?>
						</tbody>
					</table>
					<!-- Aviso Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalCenterTitle">Eliminar</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Desea eliminar esta elemento?, esta accion no se podra revertir.
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary text-capitalize" data-dismiss="modal">Cancelar</button>
									<a class="btn btn-primary text-capitalize" href="<?=BASE_DIR?>Peliculas/delete&id=<?=$cols['id_pelicula']?>">Confirmar</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</main>
</div>