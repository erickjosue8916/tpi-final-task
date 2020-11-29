<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo  ">
	<main class="container">
		<div class="row h-auto min-vh-100 justify-content-center align-items-center">
			<div class="col-md-10">
				<?php
					$headers = ['#', 'Titulo', 'Descripcion', 'Imagen', 'Stock', 'Preciolquiler', 'PrecioVenta', 'Disponibilidad', 'Likes', 'Editar', 'Eliminar'];

					$data = $result['peliculas'];
				?>
				<h1 class="text-center m-5 font-weight-light text-white display-4">Peliculas</h1>

				<div class="row justify-content-center align-items-center">
					<div class="input-group col-sm mt-3">
						<select class="custom-select input-search text-white" id="ordenInput" onchange="window.location=this.value">
							<option selected>Seleccione una opción...</option>
							<option value="<?=BASE_DIR?>Peliculas/listAdmin">Ambos</option>
							<option value="<?=BASE_DIR?>Peliculas/listAdmin&filter[disponibilidad]=Available">Disponibles</option>
							<option value="<?=BASE_DIR?>Peliculas/listAdmin&filter[disponibilidad]=Unavailable">No disponibles</option>
						</select>
					</div>
				</div>
					<?php
						foreach ($data as $key => $pelicula) {
							?>
								<div class="media m-2 bg-dark p-2 rounded text-white">
									<img class="mr-3 rounded" style="width: 100px; height:150px;" src="<?=BASE_DIR?>assets/img/movies/<?=$pelicula["imagen"]?>" alt="Imagen de la pelicula">
									<div class="media-body">
										<h2 class="mt-0 font-weight-light"><?=$pelicula["titulo"]?></h2>
										<?=$pelicula["descripcion"]?>
										<div class="mt-2 d-flex justify-content-start">
											<h6 class="font-weight-light mr-2">Precio de venta  <span class="badge badge-success">$<?=$pelicula["precio_venta"]?></span></h6>
											<h6 class="font-weight-light mr-2">Precio de alquiler  <span class="badge badge-success">$<?=$pelicula["precio_venta"]?></span></h6>
										</div>
										<div class="mt-2 d-flex justify-content-start">
											<h6 class="font-weight-light mr-2">Stock  <span class="badge badge-info"><?=$pelicula["stock"]?></span></h6>
											<h6 class="font-weight-light mr-2">Disponibilidad  <span class="badge badge-info"><?=$pelicula["disponibilidad"]?></span></h6>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a class="btn btn-outline-info text-capitalize mr-2 ml-2" href="<?=BASE_DIR?>Peliculas/update&id=<?=$pelicula['id_pelicula']?>">Editar</a>
											<button type="button" class="btn btn-outline-danger text-capitalize mr-2 ml-2" data-toggle="modal" data-target="#exampleModalCenter">Eliminar</button>
										</div>
									</div>
								</div>
							<?php
						}
					?>
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
			</div>
		</div>
	</main>
</div>