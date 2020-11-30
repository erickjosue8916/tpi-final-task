
<div class="fondo">
<main class="container">
	<!-- En este apartado se muestran las peliculas -->
	<div class="row justify-content-center align-items-center">

		<div class="input-group mb-3 col-sm m-3">
			<select class="custom-select input-search text-white" id="ordenInput">
				<option selected>Seleccione una opción...</option>
				<option value="titulo">Titulo</option>
				<option value="likes">Mas calificada</option>
			</select>
			<div class="input-group-append">
				<button class="input-group-text bg-danger text-white label-select" for="ordenInput" onclick='actualizarListadoPeliculas()'>Ordenar por</button>
			</div>
		</div>

		<div class="input-group mb-3 col-sm m-3">
			<input class="form-control input-search text-white" 
					type="text" 
					placeholder="Buscar pelicula"
					name="buscarNombre"
					id="busquedaInput"
					autocomplete="off">
			<div class="input-group-append">
				<button type="button" class="btn btn-danger" onclick='actualizarListadoPeliculas()'><i class="fas fa-search text-grey"></i></button>
			</div>
		</div>
	</div>
	<div id="peliculas"></div>
	
	<?php
		if(isset($_COOKIE['sessionId'])){//Si tiene la sesion iniciada muestra el carrito
	?>
	<!-- Carrito -->
	<div id="content" class="fabCollapse" class="animate zoomIn">
		<i id="fab" class="fa fa-shopping-cart"></i>
		<i id="close" class="fas fa-times-circle fabContent"></i>

		<div class="fabContent">
			<div class="card bg-dark p-3" id="chechoutDetails">

			</div>
			<div class="row p-2 bg-dark mx-auto operacion">
				<label class="text-center col-6 font-weight-light text-white"><input type="radio" onclick='setTotalCarrito()' name="accion" value="Alquiler"/> Alquilar</label>
				<label class="text-center col-6 font-weight-light text-white"><input type="radio" onclick='setTotalCarrito()' name="accion" value="Compra" checked="checked"/> Comprar</label>
				<h5 class="text-center text-white">Total <span class="badge badge-success" id="totalCarrito">$0.00</span></h5>
			</div>
			<div class="alert alert-warning" role="alert">
				<h4 class="alert-heading">Aviso!</h4>
				<hr>
				<p class="mb-0 font-weight-light">El tiempo de devolucion de una pelicula alquilada es de 1 semana</p>
			</div>
			<div class="text-center mt-3 p-2">
				<button type="button" class="btn btn-block btn-outline-danger" onclick="crearTransaccion(); window.location=this.value" value = "<?=BASE_DIR?>Peliculas/list;">Realizar Transaccion</button>
			</div>
		</div>
	</div>
	<!-- Fin Carrito -->
	<?php
		}
	?>
</main>
</div>