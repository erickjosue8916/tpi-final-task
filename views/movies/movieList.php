
<div class="fondo">
	<!-- En este apartado se muestran las peliculas -->
	<div class="container p-1">
		<div class="filtros">
			
				<div class="form-group">
					<label for="mid">Buscar pelicula por nombre:</label>
					  <input type="text" class="form-control" id="buscarNombre" placeholder="Buscar por nombre" name="buscarNombre" value="<?= isset($_GET["filter"]["titulo"]) ? $_GET["filter"]["titulo"] : ""?>">
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-update">Actualizar</button>
			
		</div>
		<div id="peliculas"></div>
	</div>

	<!-- Carrito -->
	<div id="content" class="fabCollapse" class="animate zoomIn">
		<i id="fab" class="fa fa-shopping-cart"></i>
		<i id="close" class="fas fa-times-circle fabContent"></i>

		<div class="fabContent">
			<div class="card bg-dark" id="chechoutDetails">
				
				
			</div>
			<div class="row">
					<label class="text-center col-6 font-weight-light text-white"><input type="radio" name="Accion" value="Comprar"/> Comprar</label>
					<label class="text-center col-6 font-weight-light text-white"><input type="radio" name="Accion" value="Alquilar"/> Alquilar</label>
				</div>
				<div class="alert alert-warning" role="alert">
					<h4 class="alert-heading">Aviso!</h4>
					<hr>
					<p class="mb-0">El tiempo de devolucion de una pelicula alquilada es de 1 semana</p>
				</div>
			<div class="text-center mt-3">
				<button type="button" class="btn btn-block btn-outline-danger">Realizar Transaccion</button>
			</div>
		</div>
	</div>
	<!-- Fin Carrito -->
</div>
