<div class="fondo">
	<!-- En este apartado se muestran las peliculas -->
	<div class="container p-1">
		<div id="peliculas"></div>
	</div>

	<!-- Carrito -->
	<div id="content" class="fabCollapse" class="animate zoomIn">
		<i id="fab" class="fa fa-shopping-cart"></i>
		<i id="close" class="fas fa-times-circle fabContent"></i>

		<div class="fabContent">
			<div class="card bg-dark">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<!-- Imagen de la pelicula -->
							<img src="<?=BASE_DIR?>assets/img/movies/the_meg.jpg" class="img-responsive mt-2" alt="">
						</div>
						<div class="col-6">
							<!-- Nombre de la pelicula -->
							<p class="font-weight-bold text-white">The Meg</p>
							<!-- Precios de venta y alquiler de la pelicula -->
							<label class="font-weight-light text-white">Comprar <p class="font-weight-bold text-success">$40</p></label><br>
							<label class="font-weight-light text-white">Alquilar <p class="font-weight-bold text-success">$50</p></label>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-6">
							<!-- Imagen de la pelicula -->
							<img src="<?=BASE_DIR?>assets/img/movies/madmax.jpg" class="img-responsive mt-2" alt="">
						</div>
						<div class="col-6">
							<!-- Nombre de la pelicula -->
							<p class="font-weight-bold text-white">Mad Max: Fury Road</p>
							<!-- Precios de venta y alquiler de la pelicula -->
							<label class="font-weight-light text-white">Comprar <p class="font-weight-bold text-success">$40</p></label><br>
							<label class="font-weight-light text-white">Alquilar <p class="font-weight-bold text-success">$50</p></label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<label class="text-center col-6 font-weight-light text-white"><input type="radio" name="Accion" value="Comprar"/> Comprar</label>
					<label class="text-center col-6 font-weight-light text-white"><input type="radio" name="Accion" value="Alquilar"/> Alquilar</label>
				</div>
			</div>
			<div class="text-center mt-3">
				<button type="button" class="btn btn-block btn-outline-danger">Realizar Transaccion</button>
			</div>
		</div>
	</div>
	<!-- Fin Carrito -->
</div>
