<?php 
  require_once "config/loginVerifier.php";
  if (isset($result["peliculas"][0])) {
    $pelicula = $result["peliculas"][0];
?>
<div class="fondo">
	<main class="container h-100 d-flex justify-content-center align-items-center">
        <content class="formu2">
			<h1 class="font-weight-light text-center">Actualizar Pelicula</h1> 
			<div class="row">
				<div class="col">
					<!-- Formulario de actualizacion de peliculas -->
					<form class="" action="<?=BASE_DIR?>Peliculas/update" method="post">
						<input type="text" hidden='true' name="id_pelicula" value="<?=$pelicula['id_pelicula']?>" >
						<div class="form-group">
							<div class="form-outline mb-4">
								<input type="text" class="form-control bg-dark text-white" id="mid" name="titulo" value="<?=$pelicula['titulo']?>" required>
								<label class="form-label text-white font-weight-light" for="mid">Titulo</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-outline mb-4">
								<textarea type="text" class="form-control bg-dark text-white" id="mdate" name="descripcion" required><?=$pelicula['descripcion']?></textarea>
								<label class="form-label text-white font-weight-light" for="mdate">Descripcion</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-outline mb-4">
								<input type="text" class="form-control bg-dark text-white" id="mlot" name="stock" value="<?=$pelicula['stock']?>" required>
								<label class="form-label text-white font-weight-light" for="mlot">Stock</label>
							</div>
						</div>

						<div class="form-group ">
							<div class="row">
								<div class="col">
									<div class="form-outline mb-4">
										<input type="text" class="form-control bg-dark text-white" id="precios" name="precio_alquiler" value="<?=$pelicula['precio_alquiler']?>" required>
										<label class="form-label text-white font-weight-light" for="mlot">Precio de alquiler</label>
									</div>
								</div>
								<div class="col">
									<div class="form-outline mb-4">
										<input type="text" class="form-control bg-dark text-white" id="precios" name="precio_venta"  value="<?=$pelicula['precio_venta']?>" required>
										<label class="form-label text-white font-weight-light" for="mlot">Precio de venta</label>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-update">Actualizar</button>
					</form>
					<!-- Fin formulario de actualizacion de peliculas -->
				</div>
			</div>
  		</content>
	</main>
</div>
<?php

}else{
   echo "<div class='alert alert-warning' role='alert'>
	No se ha encontrado la Pelicula<br><a href='". BASE_DIR . " Peliculas/listAdmin'>Regresar a Pelicula</a></div>";
}?>

