<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo">
	<main class="container h-100 d-flex justify-content-center align-items-center">
        <content class="formu2">
			<h1 class="font-weight-light text-center">Agregar Pelicula</h1> 
			<div class="row">
					<div class="col">
						<form  action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<div class="form-outline mb-4">
									<input type="text" name="titulo" class="form-control bg-dark text-white" id="mid">
									<label class="form-label text-white font-weight-light" for="mid">Titulo</label>
								</div>
							</div>

							<div class="form-group">
								<div class="form-outline mb-4">
									<textarea type="text" name="descripcion" class="form-control bg-dark text-white" id="mdate"></textarea>
									<label class="form-label text-white font-weight-light" for="mdate">Descripcion</label>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label text-white font-weight-light" for="">Imagen</label>
								<div class="custom-file">
									<input type="file" name="movieImage" class="custom-file-input bg-dark" id="exampleInputFile" onchange="this.nextElementSibling.innerText = this.files[0].name">
									<label class="custom-file-label bg-dark text-white text-truncate" for="exampleInputFile" data-browse="Buscar">Elegir archivo</label>
								</div>
							</div>

							<div class="form-group">
								<div class="form-outline mb-4">
									<input type="text" class="form-control bg-dark text-white" name="stock" id="mlot">
									<label class="form-label text-white font-weight-light" for="mlot">Stock</label>
								</div>
							</div>

							<div class="form-group ">
								<div class="row">
									<div class="col">
										<div class="form-outline mb-4">
											<input type="text" name="precio_alquiler" class="form-control bg-dark text-white" id="precios">
											<label class="form-label text-white font-weight-light" for="mlot">Precio de alquiler</label>
										</div>
									</div>
									<div class="col">
										<div class="form-outline mb-4">
											<input type="text" name="precio_venta" class="form-control bg-dark text-white" id="precios">
											<label class="form-label text-white font-weight-light" for="mlot">Precio de venta</label>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-create">Agregar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>